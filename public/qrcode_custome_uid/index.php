<?php
	include "phpqrcode/qrlib.php";

	$buatFolder = "temp/";
	if (!file_exists($buatFolder)) {
		mkdir($buatFolder);
	}

	$logoPath = "uidfinal.png"; // logo kecil, misalnya 75x75px
	$Content = "https://www.deepl.com/en/translator";

	// Buat QR code (grayscale default)
    $qrTempPath = $buatFolder . 'qrcode.png';
    QRcode::png($Content, $qrTempPath, QR_ECLEVEL_H, 20, 2);

    // Buat image true color dari QR agar support warna penuh
    $qrRaw = imagecreatefrompng($qrTempPath);
    $QR = imagecreatetruecolor(imagesx($qrRaw), imagesy($qrRaw));

    // Salin QR ke canvas truecolor
    imagecopy($QR, $qrRaw, 0, 0, 0, 0, imagesx($qrRaw), imagesy($qrRaw));

    // Baca logo PNG asli
    $logo = imagecreatefrompng($logoPath);

    imagealphablending($QR, true);
    imagesavealpha($QR, true);

    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);
    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    $dest_x = ($QR_width - $logo_width) / 2;
    $dest_y = ($QR_height - $logo_height) / 2;

    imagecopy($QR, $logo, $dest_x, $dest_y, 0, 0, $logo_width, $logo_height);

    $outputPath = $buatFolder . 'uid_with_logo.png';
    imagepng($QR, $outputPath);
    imagedestroy($QR);

    echo '<img src="'.$outputPath.'" />';
?>
