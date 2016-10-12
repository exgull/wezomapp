<?php
require_once 'ParentObject.php';

/**
 * Created by PhpStorm.
 * User: gull
 * Date: 08.10.16
 * Time: 21:47
 */
class Image extends ParentObject
{
    static $data = ['imagename', 'type', 'size'];
    protected static $table_name = "images";
    public $id;
    public $imagename;
    public $type;
    public $size;
    public $path;
    private $temp_path;
    protected $upload_dir = 'public/image';
    public $errors = [];
    static protected $upload_errors = array(
        // http://www.php.net/manual/en/features.file-upload.errors.php
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
    );

    function __construct($image)
    {
        if (isset($image['id'])) {
            $this->id = $image['id'];
            $this->imagename = $image['imagename'];
            $this->type = $image['type'];
            $this->size = $image['size'];
            $this->path = SITE_ROOT . $this->upload_dir . DS . $image['imagename'];
            return true;
        }
        if (!$image || empty($image)) {
            $this->errors[] = "No image was uploaded.";
            return false;
        } elseif ($image['error'] != 0) {
            $this->errors[] = self::$upload_errors[$image['error']];
            return false;
        } elseif (substr($image['type'], 0, 5) !== 'image') {
            $this->errors[] = "It is not Image.";
            return false;
        } else {
            list($width, $height) = getimagesize($image['tmp_name']);
            $wh = $width*$height*0.05;
//            if ($width==$height || ($width<$height && $wh>$height) || ($width>$height && $wh<$height)) {
                $this->temp_path = $image['tmp_name'];
                $this->imagename = basename($image['name']);
                $this->type = $image['type'];
                $this->size = $image['size'];
                $this->path = SITE_ROOT . $this->upload_dir . DS . $this->imagename;
                return true;
//            } else {
//                $this->errors[] = "Size this Image very bad!";
//                return false;
//            }
        }
    }
    public function renameImg($imagename) {
        if (isset($imagename) && $this->imagename != $imagename && strlen($imagename)>3) {
            $array['imagename'] = $imagename;
            if ($this->update($array)) {
                rename($this->path, SITE_ROOT.$this->upload_dir.DS.$array['imagename']);
                return true;
            } else { return false; }
        } else { return false; }
    }
    public function save($array = []) {
        if (isset($array['imagename'])) { // update()
            $this->renameImg($array['imagename']);
        } else { // create()
            if (!empty($this->errors)) { return false; }
            if (strlen($this->imagename) < 4) {
                $this->errors[] = "The image name very short.";
                return false;
            }
            if (file_exists($this->path) || self::get('imagename', $this->imagename, true)) {
                $this->errors[] = "The image '{$this->imagename}' already exists.";
                return false;
            }
            if (move_uploaded_file($this->temp_path, $this->path)) {
                if ($this->create()) {
                    unset($this->temp_path);
                    $this->errors = [];
                    return true;
                } else {
                    unlink($this->path);
                    $this->errors[] = "The image create failed, possibly due to problem with DataBase.";
                    return false;
                }
            } else {
                $this->errors[] = "The image upload failed, possibly due to incorrect permissions on the upload folder.";
                return false;
            }
        }
    }
    public function delete() {
        if (parent::delete()&&unlink($this->path)) {
            return true;
        } else { return false; }
    }



    static function replaceImg($filename, $width = 250, $height = 250) {

        $file = SITE_ROOT.'/public/image/'.$filename;
        $rgb=0xffffff;

        list($iwidth, $iheight, $image_type) = getimagesize($file); //узнаем размеры картинки и ее тип

        // $icfunc = "imagecreatefrom" . $image_type;
        // if (!function_exists($icfunc)) return false;
        switch ($image_type) //определение функции соответственно типу файла
        {
            case 1: $src = imagecreatefromgif($file); break;
            case 2: $src = imagecreatefromjpeg($file);  break;
            case 3: $src = imagecreatefrompng($file); break;
            default: return '';  break;
        }

        $x_ratio = $width / $iwidth; //пропорция ширины будущего превью
        $y_ratio = $height / $iheight; //пропорция высоты будущего превью

        $ratio = min($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio); //соотношения ширины к высоте

        $new_width = $use_x_ratio  ? $width  : floor($iwidth * $ratio); //ширина превью
        $new_height = !$use_x_ratio ? $height : floor($iheight * $ratio); //высота превью

        $new_left = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2); //расхождение с заданными параметрами по ширине
        $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2); //расхождение с заданными параметрами по высоте //расхождение с заданными параметрами по ширине

        $tmp = imagecreatetruecolor($width, $height); //создаем вспомогательное изображение пропорциональное превью
        imagefill($tmp, 0, 0, $rgb); //заливаем его


        if(($image_type == 1) OR ($image_type==3))
        {
            imagealphablending($tmp, false);
            imagesavealpha($tmp,true);
            $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
            imagefilledrectangle($tmp, 0, 0, $new_width, $new_height, $transparent);
        }
        imagecopyresampled($tmp, $src, $new_left, $new_top, 0, 0, $new_width, $new_height, $iwidth, $iheight);


        ob_start();

        switch ($image_type)
        {
            case 1: imagegif($tmp); break;
            case 2: imagejpeg($tmp, NULL, 100);  break; // best quality
            case 3: imagepng($tmp, NULL, 0); break; // no compression
            default: echo ''; break;
        }

        $final_image = ob_get_contents();

        ob_end_clean();

        return 'data:image/jpeg;base64,'.base64_encode($final_image);
    }
}