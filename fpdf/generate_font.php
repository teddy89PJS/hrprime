<?php
require('fpdf/fpdf.php');      // adjust the path if needed
require('fpdf/makefont.php');  // adjust the path if needed

// Generate DejaVuSans font files for FPDF
MakeFont('fpdf/font/DejaVuSans.ttf', 'cp1252'); // adjust path to your TTF
echo "Font generated successfully!";
