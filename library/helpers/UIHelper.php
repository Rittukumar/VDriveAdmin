<?php


class UIHelper
{

	
	public static function getOnlineStatus($last_activity, $status_check="")
	{
		if(empty($last_activity) || $last_activity == '0000-00-00 00:00:00')
		{
			return 'warning';
		}
		
		if(is_string($last_activity))
		{
			$last_activity = new DateTime($last_activity);	
		}
		   	$time = strtotime($last_activity->format('Y-m-d H:i:s'));
		 
          	$now = strtotime(date('Y-m-d H:i:s'));
           
		
       	if(($now - $time) <= 1440)
		{
			if(empty($status_check))
				return 'success';
			else
				return true;
		}
		else {
			if(empty($status_check))
				return 'warning';
			else
				return false;
			 }
	}

    public static function getchatStatus($online_status,$last_activity)
    {   

        if(empty($online_status))
        {
            return 'warning';                
            
        }
        else
        {  
          return self::getOnlineStatus($last_activity,'');
        }

    }


    public static function get_mime_type($file)
    {       
        $mime_types = array(
                "pdf"=>"application/pdf"
                ,"exe"=>"application/octet-stream"
                ,"zip"=>"application/zip"
                ,"docx"=>"application/msword"
                ,"doc"=>"application/msword"
                ,"xls"=>"application/vnd.ms-excel"
                ,"ppt"=>"application/vnd.ms-powerpoint"
                ,"gif"=>"image/gif"
                ,"png"=>"image/png"
                ,"jpeg"=>"image/jpg"
                ,"jpg"=>"image/jpg"
                ,"mp3"=>"audio/mpeg"
                ,"wav"=>"audio/x-wav"
                ,"mpeg"=>"video/mpeg"
                ,"mpg"=>"video/mpeg"
                ,"mpe"=>"video/mpeg"
                ,"mov"=>"video/quicktime"
                ,"avi"=>"video/x-msvideo"
                ,"3gp"=>"video/3gpp"
                ,"css"=>"text/css"
                ,"jsc"=>"application/javascript"
                ,"js"=>"application/javascript"
                ,"php"=>"text/html"
                ,"htm"=>"text/html"
                ,"html"=>"text/html"
        );
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return $mime_types[$extension];
    }


	public static function smiley_js($alias = '', $field_id = '')
	{
		static $do_setup = TRUE;

		$r = '';
	
		if ($alias != '' && ! is_array($alias))
		{
			$alias = array($alias => $field_id);
		}

		if ($do_setup === TRUE)
		{
				$do_setup = FALSE;
			
				$m = array();
			
				if (is_array($alias))
				{
					foreach($alias as $name => $id)
					{
						$m[] = '"'.$name.'" : "'.$id.'"';
					}
				}
			
				$m = '{'.implode(',', $m).'}';
			
				$r .= <<<EOF
			
				var smiley_map = {$m};

				function insert_smiley(smiley, field_id) {
					var el = document.getElementById(field_id), newStart;
				
					if ( ! el && smiley_map[field_id]) {
						el = document.getElementById(smiley_map[field_id]);
					
						if ( ! el)
							return false;
					}
				
					el.focus();
					smiley = " " + smiley;

					if ('selectionStart' in el) {
						newStart = el.selectionStart + smiley.length;

						el.value = el.value.substr(0, el.selectionStart) +
										smiley +
										el.value.substr(el.selectionEnd, el.value.length);
						el.setSelectionRange(newStart, newStart);
					}
					else if (document.selection) {
						document.selection.createRange().text = text;
					}
				}
EOF;
		}
		else
		{
			if (is_array($alias))
			{
				foreach($alias as $name => $id)
				{
					$r .= 'smiley_map["'.$name.'"] = "'.$id.'";'."\n";
				}
			}
		}

		return '<script type="text/javascript" charset="utf-8">'.$r.'</script>';
	}

	// ------------------------------------------------------------------------

/**
 * Get Clickable Smileys
 *
 * Returns an array of image tag links that can be clicked to be inserted 
 * into a form field.  
 *
 * @access	public
 * @param	string	the URL to the folder containing the smiley images
 * @return	array
 */
    public static function get_clickable_smileys($image_url, $alias = '', $smileys = NULL)
	{
		// For backward compatibility with js_insert_smiley
		
		if (is_array($alias))
		{
			$smileys = $alias;
		}
		
		if ( ! is_array($smileys))
		{
			if (FALSE === ($smileys = UIHelper::_get_smiley_array()))
			{
				return $smileys;
			}
		}

		// Add a trailing slash to the file path if needed
		$image_url = rtrim($image_url, '/').'/';
	
		$used = array();
		foreach ($smileys as $key => $val)
		{
			// Keep duplicates from being used, which can happen if the
			// mapping array contains multiple identical replacements.  For example:
			// :-) and :) might be replaced with the same image so both smileys
			// will be in the array.
			if (isset($used[$smileys[$key][0]]))
			{
				continue;
			}
			
			$link[] = "<a href=\"javascript:void(0);\" onClick=\"insert_smiley('".$key."', '".$alias."')\"><img src=\"".$image_url.$smileys[$key][0]."\" width=\"".$smileys[$key][1]."\" height=\"".$smileys[$key][2]."\" alt=\"".$smileys[$key][3]."\" style=\"border:0;\" /></a>";	
	
			$used[$smileys[$key][0]] = TRUE;
		}
	
		return $link;
	}

// ------------------------------------------------------------------------

/**
 * Parse Smileys
 *
 * Takes a string as input and swaps any contained smileys for the actual image
 *
 * @access	public
 * @param	string	the text to be parsed
 * @param	string	the URL to the folder containing the smiley images
 * @return	string
 */
    public static function parse_smileys($str = '', $image_url = '', $smileys = NULL, $urlPresenter = '')
	{
        if($urlPresenter != '')
        {
            $str .= UIHelper::urlPresenter_template($urlPresenter);

        }
		if ($image_url == '')
		{
			return $str;
		}

		if ( ! is_array($smileys))
		{
			if (FALSE === ($smileys = UIHelper::_get_smiley_array()))
			{
				return $str;
			}
		}

		// Add a trailing slash to the file path if needed
		$image_url = preg_replace("/(.+?)\/*$/", "\\1/",  $image_url);

		foreach ($smileys as $key => $val)
		{
			$str = str_replace($key, "<img src=\"".$image_url.$smileys[$key][0]."\" width=\"".$smileys[$key][1]."\" height=\"".$smileys[$key][2]."\" alt=\"".$smileys[$key][3]."\" style=\"border:0;\" />", $str);
		}

		return $str;
	}

// ------------------------------------------------------------------------

/**
 * Get Smiley Array
 *
 * Fetches the config/smiley.php file
 *
 * @access	private
 * @return	mixed
 */
    public static function _get_smiley_array()
	{
		$smileys = Config::get('smileys');

		return $smileys;
	}


	// ------------------------------------------------------------------------
	
	/**
	 * JS Insert Smiley
	 *
	 * Generates the javascript function needed to insert smileys into a form field
	 *
	 * DEPRECATED as of version 1.7.2, use smiley_js instead
	 *
	 * @access	public
	 * @param	string	form name
	 * @param	string	field name
	 * @return	string
	 */
	public static function js_insert_smiley($form_name = '', $form_field = '')
	{
		return <<<EOF
        <script type="text/javascript">
	    function insert_smiley(smiley)
	    {
		   document.{$form_name}.{$form_field}.value += " " + smiley;
	    }
        </script>
EOF;
	}


    public static function file_get_contents_curl($url)
    {
        $description = '';
        $keywords    = '';
        $image       = '';
        $title       = '';
        $ch          = curl_init();
       
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $data = curl_exec($ch);
        curl_close($ch);  

        

    //parsing begins here:
    $doc = new DOMDocument();
    @$doc->loadHTML($data);
    $nodes = $doc->getElementsByTagName('title');

    //get and display what you need:

    //$title = $nodes->item(0)->nodeValue;

    $metas = $doc->getElementsByTagName('meta');

    for ($i = 0; $i < $metas->length; $i++)
    {
        $meta = $metas->item($i);
        if(($meta->getAttribute('name') == 'description')||($meta->getAttribute('name') == 'Description'))
            $description = $meta->getAttribute('content');

        if(empty($description))
        {
            $meta->getAttribute('property') == 'og:description';
            $description = $meta->getAttribute('content');
        }
        if($meta->getAttribute('property') == 'og:image')
            $image = $meta->getAttribute('content');
        if(empty($image))
        {
            $image = asset('assets/img/logo-unavailable.png');
        }
        if($meta->getAttribute('name') == 'keywords')
            $keywords = $meta->getAttribute('content');
    }
   
    if(!empty($description))
    {
        return array('title'     => $title,
                 'description'   => $description ,
                 'keywords'      => $keywords,
                 'image_url'     => $image,
                 'url'           => $url);
    }
    else
    {
        return array();
    }
      
 
    }


    public static function urlPresenter_template($urlPresenter)
    {
        $str = '';
        $url_value = json_decode($urlPresenter); 
        
       if(!empty($url_value[0]))
       {
        foreach ($url_value as $key => $values)
        {
           
        $str ='  <a href="'.$values->url.'" target="_blank">
                <div class="col-md-12 " style="padding:0px;border:1px solid #D0D0D0;margin-top:1em;margin-bottom:1em;margin-right:1em;background: transparent linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%) repeat scroll 0% 0%;">
                    <div class="module2" style="background-repeat: no-repeat;">
                        <img src="'.$values->image_url.'" style="height: 100px;width: 150px;">
                        <footer >                                       
                            <p style="color:#337AB7">'.$values->description.'</p>
                        </footer>
                    </div>
                </div>
                </a>'; 
                }
               }
        return $str;
    }


}