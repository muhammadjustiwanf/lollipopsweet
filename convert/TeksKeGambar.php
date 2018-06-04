<?php
/**
 * class TeksKeGambar
 * Class ini digunakan untuk mengconvert teks ke gambar
*/
class TeksKeGambar {
    private $img;

    //Membuat gambar dari teks
    public function buatGambar($text, $ukuranFont = 20, $lebarGbr = 400, $tinggiGbr = 80){

        //path font
        $font = 'font/Roboto-Black.ttf';

        //membuat gambar
        $this->img = imagecreatetruecolor($lebarGbr, $tinggiGbr);

        //memberi warna RGB
        $white = imagecolorallocate($this->img, 44, 62, 80);
        $grey = imagecolorallocate($this->img, 128, 128, 128);
        $black = imagecolorallocate($this->img, 255, 255, 255);
        imagefilledrectangle($this->img, 0, 0, $lebarGbr - 1, $tinggiGbr - 1, $white);

        //ganti baris
        $pisahTeks = explode ( "\\n" , $text );
        $baris = count($pisahTeks);

        foreach($pisahTeks as $txt){
            $textBox = imagettfbbox($ukuranFont,$angle,$font,$txt);
            $lebarTeks = abs(max($textBox[2], $textBox[4]));
            $tinggiTeks = abs(max($textBox[5], $textBox[7]));
            $x = (imagesx($this->img) - $lebarTeks)/2;
            $y = ((imagesy($this->img) + $tinggiTeks)/2)-($baris-2)*$tinggiTeks;
            $baris = $baris-1;

            //menambahkan bayangan untuk teks
            imagettftext($this->img, $ukuranFont, $angle, $x, $y, $grey, $font, $txt);

            //menambahkan teks
            imagettftext($this->img, $ukuranFont, $angle, $x, $y, $black, $font, $txt);
        }
		return true;
    }

    //Menampilkan gambar
    public function tampilkanGambar(){
        header('Content-Type: image/png');
        return imagepng($this->img);
    }

    //Simpan gambar sebagai format png
    public function simpanKePng($namaFile = 'text-image', $lokasi = ''){
        $namaFile = $namaFile.".png";
        $namaFile = !empty($lokasi)?$lokasi.$namaFile:$namaFile;
        return imagepng($this->img, $namaFile);
    }

    //Simpan gambar sebagai format jpg
    public function simpanKeJpg($namaFile = 'text-image', $lokasi = ''){
        $namaFile = $namaFile.".jpg";
        $namaFile = !empty($lokasi)?$lokasi.$namaFile:$namaFile;
        return imagejpeg($this->img, $namaFile);
    }
}
