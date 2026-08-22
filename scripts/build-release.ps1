param(
	[string]$OutputDirectory = (Join-Path $PSScriptRoot '..\release')
)

$themeRoot = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
$outputDir = [System.IO.Path]::GetFullPath($OutputDirectory)
$archive = Join-Path $outputDir 'andonick-theme.zip'
$staging = Join-Path ([System.IO.Path]::GetTempPath()) ('andonick-release-' + [guid]::NewGuid().ToString('N'))

New-Item -ItemType Directory -Force -Path $outputDir, $staging | Out-Null
try {
	$destination = Join-Path $staging 'andonick'
	New-Item -ItemType Directory -Force -Path $destination | Out-Null
	Get-ChildItem -LiteralPath $themeRoot -Force | Where-Object {
		$_.Name -notin @('.git', 'docs', 'release', 'scripts')
	} | Copy-Item -Destination $destination -Recurse -Force
	Copy-Item -LiteralPath (Join-Path $themeRoot '.htaccess') -Destination $destination -Force

	if (Test-Path -LiteralPath $archive) { Remove-Item -LiteralPath $archive -Force }
	Compress-Archive -Path $destination -DestinationPath $archive -Force
	Write-Host "Package created: $archive"
}
finally {
	if (Test-Path -LiteralPath $staging) { Remove-Item -LiteralPath $staging -Recurse -Force }
}
