<?php
    //缩略图类
    function CreateThumbnail($path,$newFileName,$width=100,$height=100)
    {
        @$s_img = getimagesize($path);
        @$type  = $s_img[2];
        
        switch($type)
        {
            case 1 : @$im = imagecreatefromgif($path);break;
            case 2 : @$im = imagecreatefromjpeg($path); break;
            case 3 : @$im = imagecreatefrompng($path);break;
            default: $im  = false;
            break;
        }
        
        @$s_width  = imagesx($im);
        @$s_height = imagesy($im);
        
        $sizexy = getScaleImage($path,$width,$height);
        $width  = $sizexy[0];
        $height = $sizexy[1];
        
        if($im)
        {
            $im2 = imagecreatetruecolor($width,$height);
            imagecopyresized ($im2,$im,0,0,0,0,$width,$height,$s_width,$s_height);
            imagejpeg($im2,$newFileName,100);
        }
        return false;
    }
    
    function getScaleImage($image,$perfectWidth,$perfectHeight)
    {
        if (realpath($image) != false)
        {
            $sizeArray = getimagesize($image);
            $sizeX     = $sizeArray[ 0 ] ;
            $sizeY     = $sizeArray[ 1 ] ;
                
            if ($perfectWidth!=0 && $perfectHeight==0)
            {
                if ($sizeX>$perfectWidth)
                {
                    $scale = $sizeX/$sizeY ;
                    $sizeX = $perfectWidth;
                    $sizeY = floor($sizeX/$scale);
                }  
            }
        
            if ($perfectHeight != 0 && $perfectWidth == 0)
            {
                if ($sizeY > $perfectHeight)
                {
                    $scale = $sizeY / $sizeX ;
                    $sizeY = $perfectHeight;
                    $sizeX = floor($sizeY / $scale);
                }  
            }
            
            if ($perfectHeight != 0 && $perfectWidth != 0)
            {
                $sizeX = $perfectWidth;
                $sizeY = $perfectHeight;
            }
        
            $tmp[] = $sizeX;
            $tmp[] = $sizeY;
        }
        else
        {
            $tmp[] = 0;
        }
        return $tmp;
    }

?>