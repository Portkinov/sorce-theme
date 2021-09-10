<?php
namespace sorce\core;

/**
 * Arbitrary, reusable utility functions that you don't want to clutter the main functions file.
 * This is basically the theme's swiss army knife
 *
 * @package sorce
 * 
 * 

 */

class TemplateHelpers {

    /**
     * Increases or decreases the brightness of a color by a percentage of the current brightness.
     *
     * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
     * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
     *
     * @return  string
     *
     * @author  maliayas
     */

    public static function check_shortcode( $shortcode){
        
        if(!$shortcode) return false;

        $executed = \do_shortcode( $shortcode );
        #if the exectued shortcode is just the shortcode string - 
        if($executed == $shortcode) return false;

        return $executed;
    }

    public static function Spacer( $paddingtop ){
        ?>
        <div class="modspacer container-fluid" style="<?php echo $paddingtop ?>"></div>
        <?php
    }

    public static function adjustBrightness($hexCode, $adjustPercent) {
        $hexCode = ltrim($hexCode, '#');

        if (strlen($hexCode) == 3) {
            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
        }

        $hexCode = array_map('hexdec', str_split($hexCode, 2));

        foreach ($hexCode as & $color) {
            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
            $adjustAmount = ceil($adjustableLimit * $adjustPercent);

            $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
        }

        return '#' . implode($hexCode);
    }

    public static function lettercount($string){
        $array = str_split($string);
        return is_countable($array) ?  count($array) : false;
    }
        
    public static function limit_words($number, $text){
        $words = explode(' ', $text);
        $ret_text = '';
        $count = 0;
        foreach($words as $word){
          if($count < $number){
            $ret_text.= $word . ' ';
          }
          $count++;
        }
        $ret_text = trim($ret_text);
        if($ret_text !== $text) $ret_text.= '...';
    return $ret_text;
    }
    public static function split_words($number, $text){
        $split = false;

        $words = explode(' ', strip_tags($text) );
        $before_text = '';
        $finish_sentence = '';
        $sentence_complete = false;
        $after_text = '';
        $count = 0;
        foreach($words as $word){
          if($count < $number){
            $before_text.= $word . ' ';
          } else {
              if(!$sentence_complete){
                if(substr($word, -1) == '.') $sentence_complete = true;
                $finish_sentence.= $word . ' ';
              } else {
                $after_text.= $word . ' ';
              }
            
          }
          $count++;
        }
        $before_text = trim($before_text);
        $after_text = trim($after_text);
        if($before_text !== $text) {
            $before_text.= '...';
            $split = true;
        }

    return array($split, $before_text, $finish_sentence, $after_text);
    }
}