<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\components;

use Yii;
use yii\base\Component;
use yii\imagine\Image;

class Cv extends Component {
    public function lihatImageDetail($img = "", $size = "", $kategori = "") {
        $path_folder_upload = Yii::$app->params['pathUpload']; // url folder general
        $url_folder_general = Yii::$app->params['urlGeneral']; // url folder general
        $url_no_image = Yii::$app->params['urlNoImage']; // url no image
        $path_image_user = Yii::$app->params['pathImageUser']; // url image user
        $path_image_cv = Yii::$app->params['pathImageCv']; // url image cv

        $imageUrl = "";

        if (isset($img) && ($img != '')):
            if ($kategori == 'user'):
                if (file_exists($path_folder_upload . $path_image_user . $img)): // cek jika image nya tidak ada di server
                    $imageUrl = $url_folder_general . $path_image_user . $img;
                else:
                    $imageUrl = $url_folder_general . $url_no_image;
                endif;
            elseif ($kategori == 'cv'):
                if (file_exists($path_folder_upload . $path_image_cv . $img)): // cek jika image nya tidak ada di server
                    $imageUrl = $url_folder_general . $path_image_cv . $img;
                else:
                    $imageUrl = $url_folder_general . $url_no_image;
                endif;
            endif;
        else: // jika img kosong
            $imageUrl = $url_folder_general.$url_no_image;
        endif;

        return $imageUrl;
    }

    public function convertToTanggal($date, $type) {
        $tanggalIndo = "";
        $tanggal = date('d', strtotime($date));
        $tanggal = intval($tanggal);
        $bulan = date('m', strtotime($date));
        $bulan = intval($bulan) - 1;
        $tahun = date('Y', strtotime($date));
        $jam = date('H', strtotime($date));
        $menit = date('i', strtotime($date));

        $bulanArray = array("Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $bulanIndo = $bulanArray[$bulan];

        if ($type == 1) {
            $tanggalIndo = $tanggal . " " . $bulanIndo . " " . $tahun;
        } else if ($type == 2) {
            $tanggalIndo = $tanggal . " " . $bulanIndo;
        } else if ($type == 3) {
            $tanggalIndo = $tanggal . " " . $bulanIndo . " " . $tahun . " " . $jam . ":" . $menit . ' WIB';
        } else if ($type == 4) {
            $tanggalIndo = $bulanIndo . " " . $tahun;
        } else {
            //$tanggalIndo = $tanggal." ".$bulanIndo." ".$tahun." ".$jam." ".$menit;
            $tanggalIndo = $tanggal . " " . $bulanIndo . " " . $tahun . " &nbsp|&nbsp" . $jam . ":" . $menit . ' WIB';
        }

        return $tanggalIndo;
    }

}
