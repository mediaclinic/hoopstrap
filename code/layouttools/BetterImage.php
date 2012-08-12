<?php
/**
 * Prevents creation of resized images if the uploaded file already
 * fits the requested dimensions
 * - Original implementation Roman Schmid / SSBits.com
 */
class BetterImage extends Image
{   
    public function setWidth($width) {
        if($width == $this->getWidth()){
            return $this;
        }
             
        return parent::setWidth($width);
    }
     
    public function setHeight($height) {
        if($height == $this->getHeight()){
            return $this;
        }
             
        return parent::setHeight($height);
    }
     
    public function setSize($width, $height) {
        if($width == $this->getWidth() && $height == $this->getHeight()){
            return $this;
        }
         
        return parent::setSize($width, $height);
    }
     
    public function setRatioSize($width, $height) {
        if($width == $this->getWidth() && $height == $this->getHeight()){
            return $this;
        }
         
        return parent::setRatioSize($width, $height);
    }
     
    public function getFormattedImage($format, $arg1 = null, $arg2 = null) {
        if($this->ID && $this->Filename && Director::fileExists($this->Filename)) {
            $size = getImageSize(Director::baseFolder() . '/' . $this->getField('Filename'));
            $preserveOriginal = false;
            switch(strtolower($format)){
                case 'croppedimage':
                    $preserveOriginal = ($arg1 == $size[0] && $arg2 == $size[1]);
                    break;
            }
             
            if($preserveOriginal){
                return $this;
            } else {
                return parent::getFormattedImage($format, $arg1, $arg2);
            }
        }
    }
}