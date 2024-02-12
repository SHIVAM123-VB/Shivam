<?php

function getBrowser()
{
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$userBrowser = '';
	if (preg_match('/MSIE/i', $userAgent)) {
		$userBrowser = "Internet Explorer";
	} elseif (preg_match('/Firefox/i', $userAgent)) {
		$userBrowser = "Mozilla Firefox";
	} elseif (preg_match('/Safari/i', $userAgent)) {
		$userBrowser = "Apple Safari";
	} elseif (preg_match('/Chrome/i', $userAgent)) {
		$userBrowser = "Google Chrome";
	} elseif (preg_match('/Flock/i', $userAgent)) {
		$userBrowser = "Flock";
	} elseif (preg_match('/Opera/i', $userAgent)) {
		$userBrowser = "Opera";
	} elseif (preg_match('/Netscape/i', $userAgent)) {
		$userBrowser = "Netscape";
	}
	return $userBrowser;
}

function isMobile()
{
	$userAgent = $_SERVER['HTTP_USER_AGENT'];

	if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $userAgent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($userAgent, 0, 4))) {
		return true;
	} else {
		return false;
	}
}

function setStringBetween($string, $start, $end, $new_string)
{
	$string = " " . $string;
	$ini = strpos($string, $start);
	if ($ini == 0) return "";
	$ini += strlen($start);
	$len = strpos($string, $end, $ini) - $ini;
	return str_replace(substr($string, $ini, $len), $new_string, $string);
}

function getStringBetween($string, $start, $end)
{
	$string = " " . $string;
	$ini = strpos($string, $start);
	if ($ini == 0) return "";
	$ini += strlen($start);
	$len = strpos($string, $end, $ini) - $ini;
	return substr($string, $ini, $len);
}

function getStringBetweenArray($string, $start, $end)
{
	$string = " " . $string;
	$offset = 0; //starting point
	$str_ary = array();
	while (true) {
		$ini = strpos($string, $start, $offset);
		if ($ini == 0) {
			break;
		} else {
			$ini += strlen($start);
			$len = strpos($string, $end, $ini) - $ini;
			$str_ary[] = substr($string, $ini, $len);
			$offset = $ini;
		}
	}
	return $str_ary;
}

function getYoutubeVideo($vid_url, $width, $height)
{
	$vid_src = "";
	$sub_vid = substr($vid_url, 0, 4);
	if ($sub_vid == "http" || $sub_vid == "www.") {
		$chk_vid_id = strpos($vid_url, "v=");
		$chk_vid_share = strpos($vid_url, "be/");
		if ($chk_vid_id) {
			$vid_src = "https://www.youtube.com/embed/" . substr($vid_url, $chk_vid_id + 2);
		} else if ($chk_vid_share) {
			$vid_src = "https://www.youtube.com/embed/" . substr($vid_url, $chk_vid_share + 3);
		} else {
			$vid_src = $vid_url;
		}
		return '<iframe width="' . $width . '" height="' . $height . '" src="' . $vid_src . '" frameborder="0" allowfullscreen></iframe>';
	} else {
		if ($width <> "auto") {
			$vid_url = setStringBetween($vid_url, "width=\"", "\"", "$width");
		}
		if ($height <> "auto") {
			$vid_url = setStringBetween($vid_url, "height=\"", "\"", "$height");
		}
		return $vid_url;
	}
}

function deleteFile($filePath)
{
	/*$wd_was = getcwd();
	chdir(FCPATH);
	$basename($fileName);
	if(basename($fileName)<>"")
	{
		if(file_exists($fileName))
		{
			unlink($fileName);
		}
	}
	chdir($wd_was);*/
	//if(file_exists(FCPATH.$filePath))
	if (file_exists($filePath)) {
		@unlink($filePath);
	}
}

if (!function_exists('entities_to_quotes')) {
	function entities_to_quotes($str)
	{
		return str_replace(array("&#39;", "&quot;", "&#39;", "&quot;"), array("'", '"', "'", '"'), $str);
	}
}

function timeAgo($timestamp)
{
	$difference = time() - strtotime($timestamp);
	$periods = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade');
	$lengths = array('60', '60', '24', '7', '4.35', '12', '10');

	for ($j = 0; $difference >= $lengths[$j]; $j++) $difference /= $lengths[$j];

	$difference = round($difference);
	if ($difference != 1) $periods[$j] .= "s";

	return "$difference $periods[$j] ago";
}

function convert12HoursTo24Hours($time)
{
	$ampm = substr($time, -2);
	$time = substr($time, 0, -2);
	list($hours, $minutes) = explode(":", $time);
	if ($ampm == "pm" && $hours < 12) $hours = $hours + 12;
	if ($ampm == "am" && $hours == 12) $hours = $hours - 12;
	if (strlen($hours) < 2) $hours = "0" . $hours;
	if (strlen($minutes) < 2) $minutes = "0" . $minutes;
	return $hours . ":" . $minutes;
}

function secondsToTime($seconds, $ignoreSecondsOffset = false)
{
	$t = round($seconds);
	if ($ignoreSecondsOffset) {
		$time = sprintf('%02d:%02d', ($t / 3600), ($t / 60 % 60));
	} else {
		$time = sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
	}
	return $time;
}

function getAge($then)
{
	$then_ts = strtotime($then);
	$then_year = date('Y', $then_ts);
	$age = date('Y') - $then_year;
	if (strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
	return $age;

	/* Shorter Way
	$then = date('Ymd', strtotime($then));
	$diff = date('Ymd') - $then;
	return substr($diff, 0, -4); */
}

/*

************************* Please refer codeignitor's random_string() under the string library *****************************

function generateRandomKey($chars = 8,$charType='ALPHANUMERIC') {
	switch($charType)
	{
		case 'ALPHANUMERIC':
			$letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			break;
		case 'ALPHA':
			$letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
		case 'NUMERIC':
			$letters = '1234567890';
			break;
	}
	while($chars>strlen($letters))
	{
		$letters.=$letters;
	}
	return substr(str_shuffle($letters), 0, $chars);
}*/

function getPercentage($total, $number)
{
	if ($total > 0) {
		return round($number / ($total / 100));
	} else {
		return 0;
	}
}

function getImage($imagePath, $height, $width, $crop = 1)
{
	$imageUrl = base_url("data/resize.php") . "?src=" . $imagePath . "&h=$height&w=$width&zc=" . $crop;
	return $imageUrl;
}

function getExtension($filePathURL)
{
	return pathinfo($filePathURL, PATHINFO_EXTENSION);
}

function getExtensionByMIMEType($mimeType)
{
	$mimeTypes = array(array('3dm' => 'x-world/x-3dmf'), array('3dmf' => 'x-world/x-3dmf'), array('a' => 'application/octet-stream'), array('aab' => 'application/x-authorware-bin'), array('aam' => 'application/x-authorware-map'), array('aas' => 'application/x-authorware-seg'), array('abc' => 'text/vnd.abc'), array('acgi' => 'text/html'), array('afl' => 'video/animaflex'), array('ai' => 'application/postscript'), array('aif' => 'audio/aiff'), array('aif' => 'audio/x-aiff'), array('aifc' => 'audio/aiff'), array('aifc' => 'audio/x-aiff'), array('aiff' => 'audio/aiff'), array('aiff' => 'audio/x-aiff'), array('aim' => 'application/x-aim'), array('aip' => 'text/x-audiosoft-intra'), array('ani' => 'application/x-navi-animation'), array('aos' => 'application/x-nokia-9000-communicator-add-on-software'), array('aps' => 'application/mime'), array('arc' => 'application/octet-stream'), array('arj' => 'application/arj'), array('arj' => 'application/octet-stream'), array('art' => 'image/x-jg'), array('asf' => 'video/x-ms-asf'), array('asm' => 'text/x-asm'), array('asp' => 'text/asp'), array('asx' => 'application/x-mplayer2'), array('asx' => 'video/x-ms-asf'), array('asx' => 'video/x-ms-asf-plugin'), array('au' => 'audio/basic'), array('au' => 'audio/x-au'), array('avi' => 'application/x-troff-msvideo'), array('avi' => 'video/avi'), array('avi' => 'video/msvideo'), array('avi' => 'video/x-msvideo'), array('avs' => 'video/avs-video'), array('bcpio' => 'application/x-bcpio'), array('bin' => 'application/mac-binary'), array('bin' => 'application/macbinary'), array('bin' => 'application/octet-stream'), array('bin' => 'application/x-binary'), array('bin' => 'application/x-macbinary'), array('bm' => 'image/bmp'), array('bmp' => 'image/bmp'), array('bmp' => 'image/x-windows-bmp'), array('boo' => 'application/book'), array('book' => 'application/book'), array('boz' => 'application/x-bzip2'), array('bsh' => 'application/x-bsh'), array('bz' => 'application/x-bzip'), array('bz2' => 'application/x-bzip2'), array('c' => 'text/plain'), array('c++' => 'text/plain'), array('cat' => 'application/vnd.ms-pki.seccat'), array('cc' => 'text/plain'), array('cc' => 'text/x-c'), array('ccad' => 'application/clariscad'), array('cco' => 'application/x-cocoa'), array('cdf' => 'application/cdf'), array('cdf' => 'application/x-cdf'), array('cdf' => 'application/x-netcdf'), array('cer' => 'application/pkix-cert'), array('cer' => 'application/x-x509-ca-cert'), array('cha' => 'application/x-chat'), array('chat' => 'application/x-chat'), array('class' => 'application/java'), array('class' => 'application/java-byte-code'), array('class' => 'application/x-java-class'), array('com' => 'application/octet-stream'), array('com' => 'text/plain'), array('conf' => 'text/plain'), array('cpio' => 'application/x-cpio'), array('cpp' => 'text/x-c'), array('cpt' => 'application/mac-compactpro'), array('cpt' => 'application/x-compactpro'), array('cpt' => 'application/x-cpt'), array('crl' => 'application/pkcs-crl'), array('crl' => 'application/pkix-crl'), array('crt' => 'application/pkix-cert'), array('crt' => 'application/x-x509-ca-cert'), array('crt' => 'application/x-x509-user-cert'), array('csh' => 'application/x-csh'), array('csh' => 'text/x-script.csh'), array('css' => 'application/x-pointplus'), array('css' => 'text/css'), array('cxx' => 'text/plain'), array('dcr' => 'application/x-director'), array('deepv' => 'application/x-deepv'), array('def' => 'text/plain'), array('der' => 'application/x-x509-ca-cert'), array('dif' => 'video/x-dv'), array('dir' => 'application/x-director'), array('dl' => 'video/dl'), array('dl' => 'video/x-dl'), array('doc' => 'application/msword'), array('dot' => 'application/msword'), array('dp' => 'application/commonground'), array('drw' => 'application/drafting'), array('dump' => 'application/octet-stream'), array('dv' => 'video/x-dv'), array('dvi' => 'application/x-dvi'), array('dwf' => 'drawing/x-dwf (old)'), array('dwf' => 'model/vnd.dwf'), array('dwg' => 'application/acad'), array('dwg' => 'image/vnd.dwg'), array('dwg' => 'image/x-dwg'), array('dxf' => 'application/dxf'), array('dxf' => 'image/vnd.dwg'), array('dxf' => 'image/x-dwg'), array('dxr' => 'application/x-director'), array('el' => 'text/x-script.elisp'), array('elc' => 'application/x-bytecode.elisp (compiled elisp)'), array('elc' => 'application/x-elc'), array('env' => 'application/x-envoy'), array('eps' => 'application/postscript'), array('es' => 'application/x-esrehber'), array('etx' => 'text/x-setext'), array('evy' => 'application/envoy'), array('evy' => 'application/x-envoy'), array('exe' => 'application/octet-stream'), array('f' => 'text/plain'), array('f' => 'text/x-fortran'), array('f77' => 'text/x-fortran'), array('f90' => 'text/plain'), array('f90' => 'text/x-fortran'), array('fdf' => 'application/vnd.fdf'), array('fif' => 'application/fractals'), array('fif' => 'image/fif'), array('fli' => 'video/fli'), array('fli' => 'video/x-fli'), array('flo' => 'image/florian'), array('flx' => 'text/vnd.fmi.flexstor'), array('fmf' => 'video/x-atomic3d-feature'), array('for' => 'text/plain'), array('for' => 'text/x-fortran'), array('fpx' => 'image/vnd.fpx'), array('fpx' => 'image/vnd.net-fpx'), array('frl' => 'application/freeloader'), array('funk' => 'audio/make'), array('g' => 'text/plain'), array('g3' => 'image/g3fax'), array('gif' => 'image/gif'), array('gl' => 'video/gl'), array('gl' => 'video/x-gl'), array('gsd' => 'audio/x-gsm'), array('gsm' => 'audio/x-gsm'), array('gsp' => 'application/x-gsp'), array('gss' => 'application/x-gss'), array('gtar' => 'application/x-gtar'), array('gz' => 'application/x-compressed'), array('gz' => 'application/x-gzip'), array('gzip' => 'application/x-gzip'), array('gzip' => 'multipart/x-gzip'), array('h' => 'text/plain'), array('h' => 'text/x-h'), array('hdf' => 'application/x-hdf'), array('help' => 'application/x-helpfile'), array('hgl' => 'application/vnd.hp-hpgl'), array('hh' => 'text/plain'), array('hh' => 'text/x-h'), array('hlb' => 'text/x-script'), array('hlp' => 'application/hlp'), array('hlp' => 'application/x-helpfile'), array('hlp' => 'application/x-winhelp'), array('hpg' => 'application/vnd.hp-hpgl'), array('hpgl' => 'application/vnd.hp-hpgl'), array('hqx' => 'application/binhex'), array('hqx' => 'application/binhex4'), array('hqx' => 'application/mac-binhex'), array('hqx' => 'application/mac-binhex40'), array('hqx' => 'application/x-binhex40'), array('hqx' => 'application/x-mac-binhex40'), array('hta' => 'application/hta'), array('htc' => 'text/x-component'), array('htm' => 'text/html'), array('html' => 'text/html'), array('htmls' => 'text/html'), array('htt' => 'text/webviewhtml'), array('htx' => 'text/html'), array('ice' => 'x-conference/x-cooltalk'), array('ico' => 'image/x-icon'), array('idc' => 'text/plain'), array('ief' => 'image/ief'), array('iefs' => 'image/ief'), array('iges' => 'application/iges'), array('iges' => 'model/iges'), array('igs' => 'application/iges'), array('igs' => 'model/iges'), array('ima' => 'application/x-ima'), array('imap' => 'application/x-httpd-imap'), array('inf' => 'application/inf'), array('ins' => 'application/x-internett-signup'), array('ip' => 'application/x-ip2'), array('isu' => 'video/x-isvideo'), array('it' => 'audio/it'), array('iv' => 'application/x-inventor'), array('ivr' => 'i-world/i-vrml'), array('ivy' => 'application/x-livescreen'), array('jam' => 'audio/x-jam'), array('jav' => 'text/plain'), array('jav' => 'text/x-java-source'), array('java' => 'text/plain'), array('java' => 'text/x-java-source'), array('jcm' => 'application/x-java-commerce'), array('jfif' => 'image/jpeg'), array('jfif' => 'image/pjpeg'), array('jfif-tbnl' => 'image/jpeg'), array('jpe' => 'image/jpeg'), array('jpe' => 'image/pjpeg'), array('jpeg' => 'image/jpeg'), array('jpeg' => 'image/pjpeg'), array('jpg' => 'image/jpeg'), array('jpg' => 'image/pjpeg'), array('jps' => 'image/x-jps'), array('js' => 'application/x-javascript'), array('jut' => 'image/jutvision'), array('kar' => 'audio/midi'), array('kar' => 'music/x-karaoke'), array('ksh' => 'application/x-ksh'), array('ksh' => 'text/x-script.ksh'), array('la' => 'audio/nspaudio'), array('la' => 'audio/x-nspaudio'), array('lam' => 'audio/x-liveaudio'), array('latex' => 'application/x-latex'), array('lha' => 'application/lha'), array('lha' => 'application/octet-stream'), array('lha' => 'application/x-lha'), array('lhx' => 'application/octet-stream'), array('list' => 'text/plain'), array('lma' => 'audio/nspaudio'), array('lma' => 'audio/x-nspaudio'), array('log' => 'text/plain'), array('lsp' => 'application/x-lisp'), array('lsp' => 'text/x-script.lisp'), array('lst' => 'text/plain'), array('lsx' => 'text/x-la-asf'), array('ltx' => 'application/x-latex'), array('lzh' => 'application/octet-stream'), array('lzh' => 'application/x-lzh'), array('lzx' => 'application/lzx'), array('lzx' => 'application/octet-stream'), array('lzx' => 'application/x-lzx'), array('m' => 'text/plain'), array('m' => 'text/x-m'), array('m1v' => 'video/mpeg'), array('m2a' => 'audio/mpeg'), array('m2v' => 'video/mpeg'), array('m3u' => 'audio/x-mpequrl'), array('man' => 'application/x-troff-man'), array('map' => 'application/x-navimap'), array('mar' => 'text/plain'), array('mbd' => 'application/mbedlet'), array('mc' => 'application/x-magic-cap-package-1.0'), array('mcd' => 'application/mcad'), array('mcd' => 'application/x-mathcad'), array('mcf' => 'image/vasa'), array('mcf' => 'text/mcf'), array('mcp' => 'application/netmc'), array('me' => 'application/x-troff-me'), array('mht' => 'message/rfc822'), array('mhtml' => 'message/rfc822'), array('mid' => 'application/x-midi'), array('mid' => 'audio/midi'), array('mid' => 'audio/x-mid'), array('mid' => 'audio/x-midi'), array('mid' => 'music/crescendo'), array('mid' => 'x-music/x-midi'), array('midi' => 'application/x-midi'), array('midi' => 'audio/midi'), array('midi' => 'audio/x-mid'), array('midi' => 'audio/x-midi'), array('midi' => 'music/crescendo'), array('midi' => 'x-music/x-midi'), array('mif' => 'application/x-frame'), array('mif' => 'application/x-mif'), array('mime' => 'message/rfc822'), array('mime' => 'www/mime'), array('mjf' => 'audio/x-vnd.audioexplosion.mjuicemediafile'), array('mjpg' => 'video/x-motion-jpeg'), array('mm' => 'application/base64'), array('mm' => 'application/x-meme'), array('mme' => 'application/base64'), array('mod' => 'audio/mod'), array('mod' => 'audio/x-mod'), array('moov' => 'video/quicktime'), array('mov' => 'video/quicktime'), array('movie' => 'video/x-sgi-movie'), array('mp2' => 'audio/mpeg'), array('mp2' => 'audio/x-mpeg'), array('mp2' => 'video/mpeg'), array('mp2' => 'video/x-mpeg'), array('mp2' => 'video/x-mpeq2a'), array('mp3' => 'audio/mpeg3'), array('mp3' => 'audio/x-mpeg-3'), array('mp3' => 'video/mpeg'), array('mp3' => 'video/x-mpeg'), array('mpa' => 'audio/mpeg'), array('mpa' => 'video/mpeg'), array('mpc' => 'application/x-project'), array('mpe' => 'video/mpeg'), array('mpeg' => 'video/mpeg'), array('mpg' => 'audio/mpeg'), array('mpg' => 'video/mpeg'), array('mpga' => 'audio/mpeg'), array('mpp' => 'application/vnd.ms-project'), array('mpt' => 'application/x-project'), array('mpv' => 'application/x-project'), array('mpx' => 'application/x-project'), array('mrc' => 'application/marc'), array('ms' => 'application/x-troff-ms'), array('mv' => 'video/x-sgi-movie'), array('my' => 'audio/make'), array('mzz' => 'application/x-vnd.audioexplosion.mzz'), array('nap' => 'image/naplps'), array('naplps' => 'image/naplps'), array('nc' => 'application/x-netcdf'), array('ncm' => 'application/vnd.nokia.configuration-message'), array('nif' => 'image/x-niff'), array('niff' => 'image/x-niff'), array('nix' => 'application/x-mix-transfer'), array('nsc' => 'application/x-conference'), array('nvd' => 'application/x-navidoc'), array('o' => 'application/octet-stream'), array('oda' => 'application/oda'), array('omc' => 'application/x-omc'), array('omcd' => 'application/x-omcdatamaker'), array('omcr' => 'application/x-omcregerator'), array('p' => 'text/x-pascal'), array('p10' => 'application/pkcs10'), array('p10' => 'application/x-pkcs10'), array('p12' => 'application/pkcs-12'), array('p12' => 'application/x-pkcs12'), array('p7a' => 'application/x-pkcs7-signature'), array('p7c' => 'application/pkcs7-mime'), array('p7c' => 'application/x-pkcs7-mime'), array('p7m' => 'application/pkcs7-mime'), array('p7m' => 'application/x-pkcs7-mime'), array('p7r' => 'application/x-pkcs7-certreqresp'), array('p7s' => 'application/pkcs7-signature'), array('part' => 'application/pro_eng'), array('pas' => 'text/pascal'), array('pbm' => 'image/x-portable-bitmap'), array('pcl' => 'application/vnd.hp-pcl'), array('pcl' => 'application/x-pcl'), array('pct' => 'image/x-pict'), array('pcx' => 'image/x-pcx'), array('pdb' => 'chemical/x-pdb'), array('pdf' => 'application/pdf'), array('pfunk' => 'audio/make'), array('pgm' => 'image/x-portable-greymap'), array('pic' => 'image/pict'), array('pict' => 'image/pict'), array('pkg' => 'application/x-newton-compatible-pkg'), array('pko' => 'application/vnd.ms-pki.pko'), array('pl' => 'text/plain'), array('pl' => 'text/x-script.perl'), array('plx' => 'application/x-pixclscript'), array('pm' => 'image/x-xpixmap'), array('pm' => 'text/x-script.perl-module'), array('pm4' => 'application/x-pagemaker'), array('pm5' => 'application/x-pagemaker'), array('png' => 'image/png'), array('pnm' => 'application/x-portable-anymap'), array('pnm' => 'image/x-portable-anymap'), array('pot' => 'application/mspowerpoint'), array('pot' => 'application/vnd.ms-powerpoint'), array('pov' => 'model/x-pov'), array('ppa' => 'application/vnd.ms-powerpoint'), array('ppm' => 'image/x-portable-pixmap'), array('pps' => 'application/mspowerpoint'), array('pps' => 'application/vnd.ms-powerpoint'), array('ppt' => 'application/mspowerpoint'), array('ppt' => 'application/powerpoint'), array('ppt' => 'application/vnd.ms-powerpoint'), array('ppt' => 'application/x-mspowerpoint'), array('ppz' => 'application/mspowerpoint'), array('pre' => 'application/x-freelance'), array('prt' => 'application/pro_eng'), array('ps' => 'application/postscript'), array('psd' => 'application/octet-stream'), array('pvu' => 'paleovu/x-pv'), array('pwz' => 'application/vnd.ms-powerpoint'), array('py' => 'text/x-script.phyton'), array('pyc' => 'applicaiton/x-bytecode.python'), array('qcp' => 'audio/vnd.qcelp'), array('qd3' => 'x-world/x-3dmf'), array('qd3d' => 'x-world/x-3dmf'), array('qif' => 'image/x-quicktime'), array('qt' => 'video/quicktime'), array('qtc' => 'video/x-qtc'), array('qti' => 'image/x-quicktime'), array('qtif' => 'image/x-quicktime'), array('ra' => 'audio/x-pn-realaudio'), array('ra' => 'audio/x-pn-realaudio-plugin'), array('ra' => 'audio/x-realaudio'), array('ram' => 'audio/x-pn-realaudio'), array('ras' => 'application/x-cmu-raster'), array('ras' => 'image/cmu-raster'), array('ras' => 'image/x-cmu-raster'), array('rast' => 'image/cmu-raster'), array('rexx' => 'text/x-script.rexx'), array('rf' => 'image/vnd.rn-realflash'), array('rgb' => 'image/x-rgb'), array('rm' => 'application/vnd.rn-realmedia'), array('rm' => 'audio/x-pn-realaudio'), array('rmi' => 'audio/mid'), array('rmm' => 'audio/x-pn-realaudio'), array('rmp' => 'audio/x-pn-realaudio'), array('rmp' => 'audio/x-pn-realaudio-plugin'), array('rng' => 'application/ringing-tones'), array('rng' => 'application/vnd.nokia.ringing-tone'), array('rnx' => 'application/vnd.rn-realplayer'), array('roff' => 'application/x-troff'), array('rp' => 'image/vnd.rn-realpix'), array('rpm' => 'audio/x-pn-realaudio-plugin'), array('rt' => 'text/richtext'), array('rt' => 'text/vnd.rn-realtext'), array('rtf' => 'application/rtf'), array('rtf' => 'application/x-rtf'), array('rtf' => 'text/richtext'), array('rtx' => 'application/rtf'), array('rtx' => 'text/richtext'), array('rv' => 'video/vnd.rn-realvideo'), array('s' => 'text/x-asm'), array('s3m' => 'audio/s3m'), array('saveme' => 'aapplication/octet-stream'), array('sbk' => 'application/x-tbook'), array('scm' => 'application/x-lotusscreencam'), array('scm' => 'text/x-script.guile'), array('scm' => 'text/x-script.scheme'), array('scm' => 'video/x-scm'), array('sdml' => 'text/plain'), array('sdp' => 'application/sdp'), array('sdp' => 'application/x-sdp'), array('sdr' => 'application/sounder'), array('sea' => 'application/sea'), array('sea' => 'application/x-sea'), array('set' => 'application/set'), array('sgm' => 'text/sgml'), array('sgm' => 'text/x-sgml'), array('sgml' => 'text/sgml'), array('sgml' => 'text/x-sgml'), array('sh' => 'application/x-bsh'), array('sh' => 'application/x-sh'), array('sh' => 'application/x-shar'), array('sh' => 'text/x-script.sh'), array('shar' => 'application/x-bsh'), array('shar' => 'application/x-shar'), array('shtml' => 'text/html'), array('shtml' => 'text/x-server-parsed-html'), array('sid' => 'audio/x-psid'), array('sit' => 'application/x-sit'), array('sit' => 'application/x-stuffit'), array('skd' => 'application/x-koan'), array('skm' => 'application/x-koan'), array('skp' => 'application/x-koan'), array('skt' => 'application/x-koan'), array('sl' => 'application/x-seelogo'), array('smi' => 'application/smil'), array('smil' => 'application/smil'), array('snd' => 'audio/basic'), array('snd' => 'audio/x-adpcm'), array('sol' => 'application/solids'), array('spc' => 'application/x-pkcs7-certificates'), array('spc' => 'text/x-speech'), array('spl' => 'application/futuresplash'), array('spr' => 'application/x-sprite'), array('sprite' => 'application/x-sprite'), array('src' => 'application/x-wais-source'), array('ssi' => 'text/x-server-parsed-html'), array('ssm' => 'application/streamingmedia'), array('sst' => 'application/vnd.ms-pki.certstore'), array('step' => 'application/step'), array('stl' => 'application/sla'), array('stl' => 'application/vnd.ms-pki.stl'), array('stl' => 'application/x-navistyle'), array('stp' => 'application/step'), array('sv4cpio' => 'application/x-sv4cpio'), array('sv4crc' => 'application/x-sv4crc'), array('svf' => 'image/vnd.dwg'), array('svf' => 'image/x-dwg'), array('svr' => 'application/x-world'), array('svr' => 'x-world/x-svr'), array('swf' => 'application/x-shockwave-flash'), array('t' => 'application/x-troff'), array('talk' => 'text/x-speech'), array('tar' => 'application/x-tar'), array('tbk' => 'application/toolbook'), array('tbk' => 'application/x-tbook'), array('tcl' => 'application/x-tcl'), array('tcl' => 'text/x-script.tcl'), array('tcsh' => 'text/x-script.tcsh'), array('tex' => 'application/x-tex'), array('texi' => 'application/x-texinfo'), array('texinfo' => ' lication/x-texinfo'), array('text' => 'application/plain'), array('text' => 'text/plain'), array('tgz' => 'application/gnutar'), array('tgz' => 'application/x-compressed'), array('tif' => 'image/tiff'), array('tif' => 'image/x-tiff'), array('tiff' => 'image/tiff'), array('tiff' => 'image/x-tiff'), array('tr' => 'application/x-troff'), array('tsi' => 'audio/tsp-audio'), array('tsp' => 'application/dsptype'), array('tsp' => 'audio/tsplayer'), array('tsv' => 'text/tab-separated-values'), array('turbot' => 'image/florian'), array('txt' => 'text/plain'), array('uil' => 'text/x-uil'), array('uni' => 'text/uri-list'), array('unis' => 'text/uri-list'), array('unv' => 'application/i-deas'), array('uri' => 'text/uri-list'), array('uris' => 'text/uri-list'), array('ustar' => 'application/x-ustar'), array('ustar' => 'multipart/x-ustar'), array('uu' => 'application/octet-stream'), array('uu' => 'text/x-uuencode'), array('uue' => 'text/x-uuencode'), array('vcd' => 'application/x-cdlink'), array('vcs' => 'text/x-vcalendar'), array('vda' => 'application/vda'), array('vdo' => 'video/vdo'), array('vew' => 'application/groupwise'), array('viv' => 'video/vivo'), array('viv' => 'video/vnd.vivo'), array('vivo' => 'video/vivo'), array('vivo' => 'video/vnd.vivo'), array('vmd' => 'application/vocaltec-media-desc'), array('vmf' => 'application/vocaltec-media-file'), array('voc' => 'audio/voc'), array('voc' => 'audio/x-voc'), array('vos' => 'video/vosaic'), array('vox' => 'audio/voxware'), array('vqe' => 'audio/x-twinvq-plugin'), array('vqf' => 'audio/x-twinvq'), array('vql' => 'audio/x-twinvq-plugin'), array('vrml' => 'application/x-vrml'), array('vrml' => 'model/vrml'), array('vrml' => 'x-world/x-vrml'), array('vrt' => 'x-world/x-vrt'), array('vsd' => 'application/x-visio'), array('vst' => 'application/x-visio'), array('vsw' => 'application/x-visio'), array('w60' => 'application/wordperfect6.0'), array('w61' => 'application/wordperfect6.1'), array('w6w' => 'application/msword'), array('wav' => 'audio/wav'), array('wav' => 'audio/x-wav'), array('wb1' => 'application/x-qpro'), array('wbmp' => 'image/vnd.wap.wbmp'), array('web' => 'application/vnd.xara'), array('wiz' => 'application/msword'), array('wk1' => 'application/x-123'), array('wmf' => 'windows/metafile'), array('wml' => 'text/vnd.wap.wml'), array('wmlc' => 'application/vnd.wap.wmlc'), array('wmls' => 'text/vnd.wap.wmlscript'), array('wmlsc' => 'application/vnd.wap.wmlscriptc'), array('word' => 'application/msword'), array('wp' => 'application/wordperfect'), array('wp5' => 'application/wordperfect'), array('wp5' => 'application/wordperfect6.0'), array('wp6' => 'application/wordperfect'), array('wpd' => 'application/wordperfect'), array('wpd' => 'application/x-wpwin'), array('wq1' => 'application/x-lotus'), array('wri' => 'application/mswrite'), array('wri' => 'application/x-wri'), array('wrl' => 'application/x-world'), array('wrl' => 'model/vrml'), array('wrl' => 'x-world/x-vrml'), array('wrz' => 'model/vrml'), array('wrz' => 'x-world/x-vrml'), array('wsc' => 'text/scriplet'), array('wsrc' => 'application/x-wais-source'), array('wtk' => 'application/x-wintalk'), array('xbm' => 'image/x-xbitmap'), array('xbm' => 'image/x-xbm'), array('xbm' => 'image/xbm'), array('xdr' => 'video/x-amt-demorun'), array('xgz' => 'xgl/drawing'), array('xif' => 'image/vnd.xiff'), array('xl' => 'application/excel'), array('xla' => 'application/excel'), array('xla' => 'application/x-excel'), array('xla' => 'application/x-msexcel'), array('xlb' => 'application/excel'), array('xlb' => 'application/vnd.ms-excel'), array('xlb' => 'application/x-excel'), array('xlc' => 'application/excel'), array('xlc' => 'application/vnd.ms-excel'), array('xlc' => 'application/x-excel'), array('xld' => 'application/excel'), array('xld' => 'application/x-excel'), array('xlk' => 'application/excel'), array('xlk' => 'application/x-excel'), array('xll' => 'application/excel'), array('xll' => 'application/vnd.ms-excel'), array('xll' => 'application/x-excel'), array('xlm' => 'application/excel'), array('xlm' => 'application/vnd.ms-excel'), array('xlm' => 'application/x-excel'), array('xls' => 'application/excel'), array('xls' => 'application/vnd.ms-excel'), array('xls' => 'application/x-excel'), array('xls' => 'application/x-msexcel'), array('xlt' => 'application/excel'), array('xlt' => 'application/x-excel'), array('xlv' => 'application/excel'), array('xlv' => 'application/x-excel'), array('xlw' => 'application/excel'), array('xlw' => 'application/vnd.ms-excel'), array('xlw' => 'application/x-excel'), array('xlw' => 'application/x-msexcel'), array('xm' => 'audio/xm'), array('xml' => 'application/xml'), array('xml' => 'text/xml'), array('xmz' => 'xgl/movie'), array('xpix' => 'application/x-vnd.ls-xpix'), array('xpm' => 'image/x-xpixmap'), array('xpm' => 'image/xpm'), array('xsr' => 'video/x-amt-showrun'), array('xwd' => 'image/x-xwd'), array('xwd' => 'image/x-xwindowdump'), array('xyz' => 'chemical/x-pdb'), array('z' => 'application/x-compress'), array('z' => 'application/x-compressed'), array('zip' => 'application/x-compressed'), array('zip' => 'application/x-zip-compressed'), array('zip' => 'application/zip'), array('zip' => 'multipart/x-zip'), array('zoo' => 'application/octet-stream'), array('zsh' => 'text/x-script.zsh'));

	$extension = false;
	foreach ($mimeTypes as $mimeTypeInfo) {
		if ($mimeType == array_values($mimeTypeInfo)[0]) {
			$extension = array_keys($mimeTypeInfo)[0];
		}
	}
	return $extension;
}

function getFileContentType($fileContent)
{
	$fileInfo = false;
	if ($fileContent != '') {
		$fileInfo = [];
		$fileContent = str_replace("[removed]", "", $fileContent);
		$fileContentObj = base64_decode($fileContent);
		$fileInfoStream = finfo_open();
		$fileMIMEType = finfo_buffer($fileInfoStream, $fileContentObj, FILEINFO_MIME_TYPE);
		$fileExtension = getExtensionByMIMEType($fileMIMEType);
		if ($fileMIMEType !== false) {
			$fileInfo['mime_type'] = $fileMIMEType;
		}
		if ($fileExtension !== false) {
			$fileInfo['extension'] = $fileExtension;
		}
	}
	return $fileInfo;
}

function getExcerpt($content, $length, $suffix = "...")
{
	if (strlen($content) > $length + strlen($suffix)) {
		$excerpt = substr($content, 0, $length);
		$excerpt .= $suffix;
	} else {
		$excerpt = $content;
	}
	return $excerpt;
}

function chkEmptyRequests($required_fields_arr, $request_type = "POST")
{
	$empty_fields_arr = array();

	foreach ($required_fields_arr as $required_field) {
		$request_type = (in_array($request_type, array("REQUEST", "GET", "POST"))) ? $request_type : "REQUEST";
		if ($request_type == "REQUEST") {
			if (!isset($_REQUEST[$required_field]) || trim($_REQUEST[$required_field]) == "") {
				$empty_fields_arr[] = $required_field;
			}
		} elseif ($request_type == "GET") {
			if (!isset($_GET[$required_field]) || trim($_GET[$required_field]) == "") {
				$empty_fields_arr[] = $required_field;
			}
		} elseif ($request_type == "POST") {
			if (!isset($_POST[$required_field]) || trim($_POST[$required_field]) == "") {
				$empty_fields_arr[] = $required_field;
			}
		}
	}

	/*if(count($empty_fields_arr)>0)
	{*/
	return $empty_fields_arr;
	/*}*/
}
function isJSON($str)
{
	($str!=null) ? json_decode($str) : $str;
	return (json_last_error() == JSON_ERROR_NONE);
}
function strEscape($str)
{
	if (isJSON($str)) {
		$str = str_replace(array("'"), array("&apos;"), $str);
	} else {
		$str = ($str!=null) ? quotes_to_entities($str) : $str;
	}
	return $str;
}
