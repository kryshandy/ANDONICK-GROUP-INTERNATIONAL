param(
	[string]$BaseUrl = 'http://localhost/wordpress',
	[switch]$BuildRelease,
	[string]$PhpPath = ''
)

$ErrorActionPreference = 'Stop'
$themeRoot = (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path
$siteRoot = (Resolve-Path (Join-Path $themeRoot '..\..\..')).Path
$installedPluginRoot = Join-Path $siteRoot 'wp-content\plugins\andonick-core'
$bundledPluginRoot = Join-Path $themeRoot 'companion-plugin\andonick-core'
$pluginRoot = if (Test-Path -LiteralPath $installedPluginRoot) { $installedPluginRoot } else { $bundledPluginRoot }
$php = if ($PhpPath) {
	$PhpPath
} elseif (Test-Path -LiteralPath 'C:\xampp\php\php.exe') {
	'C:\xampp\php\php.exe'
} else {
	(Get-Command php -ErrorAction Stop).Source
}
$failed = [System.Collections.Generic.List[string]]::new()
$passed = 0

function Assert-Check {
	param([string]$Name, [bool]$Condition, [string]$Detail = '')
	if ($Condition) {
		$script:passed++
		Write-Host "PASS  $Name"
	} else {
		$script:failed.Add($Name + $(if ($Detail) { ': ' + $Detail } else { '' }))
		Write-Host "FAIL  $Name $Detail"
	}
}

function Get-Response {
	param([string]$Path)
	$uri = $BaseUrl.TrimEnd('/') + '/' + $Path.TrimStart('/')
	try {
		return Invoke-WebRequest -Uri $uri -UseBasicParsing -MaximumRedirection 3
	} catch [System.Net.WebException] {
		$response = $_.Exception.Response
		if ($null -eq $response) { throw }
		$reader = [System.IO.StreamReader]::new($response.GetResponseStream())
		try {
			return [pscustomobject]@{
				StatusCode = [int]$response.StatusCode
				Content    = $reader.ReadToEnd()
				Headers    = $response.Headers
			}
		} finally {
			$reader.Dispose()
			$response.Dispose()
		}
	}
}

Push-Location $siteRoot
try {
	$phpFiles = Get-ChildItem $themeRoot,$pluginRoot -Recurse -Filter *.php -File
	foreach ($file in $phpFiles) {
		$output = & $php -l $file.FullName 2>&1
		Assert-Check ("PHP syntax " + $file.Name) ($LASTEXITCODE -eq 0) ($output -join ' ')
	}

	$jsOutput = & node --check (Join-Path $themeRoot 'assets\js\main.js') 2>&1
	Assert-Check 'JavaScript syntax' ($LASTEXITCODE -eq 0) ($jsOutput -join ' ')

	$style = Get-Content -Raw (Join-Path $themeRoot 'style.css')
	Assert-Check 'Theme version 4.0.0' ($style -match 'Version:\s*4\.0\.0')
	Assert-Check 'Official primary colour' ($style -match '#461491')
	Assert-Check 'Official dark colour' ($style -match '#2A0A63')
	Assert-Check 'Header logo minimum width' ($style -match '(?s)\.brand-logo\s*\{[^}]*width:\s*clamp\(120px')

	$content = Get-Content -Raw (Join-Path $themeRoot 'inc\content.php')
	Assert-Check 'No unsupported official Starlink claim' ($content -notmatch '(?i)distributeur officiel starlink|official starlink distributor')
	Assert-Check 'No historic private reference phones' ($content -notmatch '\+236 72 (68 33 37|52 27 26|14 96 15|68 13 54)')
	Assert-Check 'Eight domains retained' (([regex]::Matches($content, "array\( 'num' => '0[1-8]'" )).Count -ge 16)

	$dbProbe = & $php -r "require 'wp-load.php'; echo (in_array('andonick-core/andonick-core.php',get_option('active_plugins',array()),true)?'active':'inactive').'|'.(int)wp_count_posts('andonick_project')->publish.'|'.get_option('show_on_front').'|'.get_option('page_on_front').'|'.get_option('wp_page_for_privacy_policy').'|'.(WP_DEBUG?'debug':'nodebug').'|'.(defined('DISALLOW_FILE_EDIT')&&DISALLOW_FILE_EDIT?'noedit':'edit');"
	$db = ($dbProbe -join '').Trim().Split('|')
	Assert-Check 'ANDONICK Core active' ($db[0] -eq 'active')
	Assert-Check 'Four documented projects' ($db[1] -eq '4')
	Assert-Check 'Static front page configured' ($db[2] -eq 'page' -and [int]$db[3] -gt 0)
	Assert-Check 'Privacy page configured' ([int]$db[4] -gt 0)
	Assert-Check 'Debug disabled' ($db[5] -eq 'nodebug')
	Assert-Check 'File editor disabled' ($db[6] -eq 'noedit')

	$homeResponse = Get-Response '/'
	$english = Get-Response '/?lang=en'
	$privacy = Get-Response '/politique-de-confidentialite/'
	$privacyEn = Get-Response '/privacy-policy/?lang=en'
	$missing = Get-Response '/recette-page-introuvable-andonick/'
	$robots = Get-Response '/robots.txt'
	$sitemap = Get-Response '/wp-sitemap.xml'

	Assert-Check 'Homepage HTTP 200' ($homeResponse.StatusCode -eq 200)
	Assert-Check 'English homepage HTTP 200' ($english.StatusCode -eq 200)
	Assert-Check 'Privacy page HTTP 200' ($privacy.StatusCode -eq 200)
	Assert-Check 'English privacy page HTTP 200' ($privacyEn.StatusCode -eq 200 -and $privacyEn.Content -match '<html[^>]+lang="en-US"')
	Assert-Check 'Legal translation hreflang' ($privacyEn.Content -match 'hreflang="fr"' -and $privacyEn.Content -match 'hreflang="en"')
	Assert-Check '404 returns HTTP 404' ($missing.StatusCode -eq 404)
	Assert-Check 'robots.txt HTTP 200' ($robots.StatusCode -eq 200 -and $robots.Content -match 'Sitemap:')
	Assert-Check 'Sitemap HTTP 200 XML' ($sitemap.StatusCode -eq 200 -and $sitemap.Content -match '<sitemapindex')
	Assert-Check 'Security nosniff header' ($homeResponse.Headers['X-Content-Type-Options'] -contains 'nosniff')
	Assert-Check 'Frame protection header' ($homeResponse.Headers['X-Frame-Options'] -contains 'SAMEORIGIN')

	$html = $homeResponse.Content
	Assert-Check 'Exactly one H1' (([regex]::Matches($html, '<h1\b', 'IgnoreCase')).Count -eq 1)
	Assert-Check 'French document language' ($html -match '<html[^>]+lang="fr-FR"')
	Assert-Check 'English document language' ($english.Content -match '<html[^>]+lang="en-US"')
	Assert-Check 'Two public forms rendered' (([regex]::Matches($html, '<form\b', 'IgnoreCase')).Count -ge 2)
	Assert-Check 'Consent controls rendered' ($html -match 'id="andonick-consent-devis"' -and $html -match 'id="andonick-consent-rappel"')
	Assert-Check 'Privacy links rendered in forms' ($html -match 'politique-de-confidentialite')
	Assert-Check 'English legal footer linked' ($english.Content -match 'privacy-policy/\?lang=en' -and $english.Content -match 'cookie-policy/\?lang=en')
	Assert-Check 'Project proof section rendered' ($html -match 'id="projets"' -and $html -match 'Solarisation de trois CLAC')
	Assert-Check 'Open Graph image fallback' ($html -match '<meta property="og:image"')
	Assert-Check 'Organization JSON-LD' ($html -match 'application/ld\+json' -and $html -match '"@type":"Organization"')
	Assert-Check 'No cookie banner by default' ($html -notmatch 'id="cookieBanner"')

	$ids = [regex]::Matches($html, '\sid="([^"]+)"', 'IgnoreCase') | ForEach-Object { $_.Groups[1].Value }
	$duplicates = $ids | Group-Object | Where-Object Count -gt 1
	Assert-Check 'No duplicate HTML IDs' ($null -eq $duplicates) (($duplicates.Name -join ', '))

	if ($BuildRelease) {
		& (Join-Path $themeRoot 'scripts\build-release.ps1') | Out-Host
		$themeZip = Join-Path $themeRoot 'release\andonick-theme.zip'
		$coreZip = Join-Path $themeRoot 'release\andonick-core.zip'
		Assert-Check 'Theme release archive exists' (Test-Path -LiteralPath $themeZip)
		Assert-Check 'Core release archive exists' (Test-Path -LiteralPath $coreZip)
		if (Test-Path -LiteralPath $themeZip) {
			Add-Type -AssemblyName System.IO.Compression.FileSystem
			$zip = [System.IO.Compression.ZipFile]::OpenRead($themeZip)
			try {
				$names = $zip.Entries.FullName | ForEach-Object { $_ -replace '\\', '/' }
				Assert-Check 'Release excludes internal docs' (-not ($names -match '(^|/)docs/'))
				Assert-Check 'Release contains theme stylesheet' ($names -contains 'andonick/style.css')
			} finally { $zip.Dispose() }
		}
	}
}
finally {
	Pop-Location
}

Write-Host ""
Write-Host ("Passed: {0}  Failed: {1}" -f $passed,$failed.Count)
if ($failed.Count -gt 0) {
	$failed | ForEach-Object { Write-Host (" - " + $_) }
	exit 1
}
