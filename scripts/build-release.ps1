param(
	[string]$OutputDirectory = (Join-Path $PSScriptRoot '..\release')
)

$themeRoot = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
$bundledPluginRoot = Join-Path $themeRoot 'companion-plugin\andonick-core'
$installedPluginRoot = Join-Path $themeRoot '..\..\plugins\andonick-core'
if (Test-Path -LiteralPath $bundledPluginRoot) {
	$pluginRoot = (Resolve-Path $bundledPluginRoot).Path
} elseif (Test-Path -LiteralPath $installedPluginRoot) {
	$pluginRoot = (Resolve-Path $installedPluginRoot).Path
} else {
	throw 'ANDONICK Core est introuvable dans companion-plugin/ et dans l installation WordPress.'
}
$outputDir = [System.IO.Path]::GetFullPath($OutputDirectory)
$archive = Join-Path $outputDir 'andonick-theme.zip'
$pluginArchive = Join-Path $outputDir 'andonick-core.zip'
$staging = Join-Path ([System.IO.Path]::GetTempPath()) ('andonick-release-' + [guid]::NewGuid().ToString('N'))

New-Item -ItemType Directory -Force -Path $outputDir, $staging | Out-Null
try {
	$destination = Join-Path $staging 'andonick'
	New-Item -ItemType Directory -Force -Path $destination | Out-Null
	Get-ChildItem -LiteralPath $themeRoot -Force | Where-Object {
		$_.Name -notin @('.git', '.github', '.gitignore', 'companion-plugin', 'docs', 'release', 'scripts', 'CHANGELOG.md')
	} | Copy-Item -Destination $destination -Recurse -Force
	Copy-Item -LiteralPath (Join-Path $themeRoot '.htaccess') -Destination $destination -Force

	if (Test-Path -LiteralPath $archive) { Remove-Item -LiteralPath $archive -Force }
	Compress-Archive -Path $destination -DestinationPath $archive -Force
	Write-Host "Package created: $archive"

	$pluginDestination = Join-Path $staging 'andonick-core'
	Copy-Item -LiteralPath $pluginRoot -Destination $pluginDestination -Recurse -Force
	if (Test-Path -LiteralPath $pluginArchive) { Remove-Item -LiteralPath $pluginArchive -Force }
	Compress-Archive -Path $pluginDestination -DestinationPath $pluginArchive -Force
	Write-Host "Package created: $pluginArchive"
}
finally {
	if (Test-Path -LiteralPath $staging) { Remove-Item -LiteralPath $staging -Recurse -Force }
}
