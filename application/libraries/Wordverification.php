<?php

/*
 * Word Verification
 * 
 * This class provides functionality for word verification to be used in all
 * the modules, it stores the generated captchas for specified time and 
 * checks for validation. It can be used easily for multiple times in a 
 * single page (the default validity is for up to 30mins. 
 * 
 * Uses EASF System Helper :: Captcha
 * 
 * @author $Author: milan $:
 * @version SVN: $Id: wordverification.php 6062 2012-08-22 09:27:14Z milan $:
 * @revision $Rev: 6062 $:
 * @date $Date: 2012-08-22 14:57:14 +0530 (Wed, 22 Aug 2012) $:
 * @class wordverification
 * @package EASF
 * 
 */

class wordverification {

    var $EASF;
    var $CAPTCHA;
    var $img_path;

    function __construct() {
        $this->EASF = & get_instance();
        $this->EASF->load->helper('captcha');
        $this->img_path = ROOTBASEPATH . 'media/captcha/';
        
		/* TODO: 
         * - Add option for length for captcha, currently it is hardcoded as 4 system captcha helper
         * - Add option for font and font sizes
         * - Add option for foreground and background color
         */
        
    }

    /*
     * function getWord
     * @return String HTML Image tag
     */

    function getImg() {
        $vals = array(
            'img_path' => $this->img_path,
            'img_url' => base_url() . 'media/captcha/',
            'font_path' => ROOTBASEPATH . 'fonts/captcha/Stanberry.ttf',
            'img_width' => '100',
            'img_height' => 30,
            'expiration' => 1800
        );
     
        
        $cap = create_captcha($vals);
      
	  $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->EASF->input->ip_address(),
            'word' => $cap['word']
        );

        $query = $this->EASF->db->insert_string('captcha', $data);
        $this->EASF->db->query($query);

    

        //print_r($vals);
        return $cap['image'];
    }

    /*
     * function checkWord
     * @param String word
     * @return Boolean
     */

    function checkWord($word = '') {
        $status = FALSE;

        if (!empty($word)) {
            // First, delete old captchas
            $this->_flush_all_expired_words();
            $expiration = time()-1800; // 30mins limit
            // Then see if a captcha exists:
            $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
            $binds = array($word, $this->EASF->input->ip_address(), $expiration);
            $query = $this->EASF->db->query($sql, $binds);
            $row = $query->row();

            if ($row->count > 0) {
                $status = TRUE;
            }
        }

        return $status;
    }

    /*
     * Flush all expired words in database
     */

    function _flush_all_expired_words() {
        $expiration = time() - 1800; // 30mins limit
        
        $this->EASF->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);
    }
    
    
}