<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CtrlAtelier.php');

$controleur= new CtrlAtelier('dbserver','acleret','azerty','acleret');
$atelier;
$desc;
$AtelierExist = false;

$titleErr = $themeErr = $notesErr = $placeErr =
    $durationErr = $resumeErr = $capacityErr = $partnerErr =
    $contentErr = $targetErr = "";
$title = $theme = $notes = $place = $duration =
    $resume = $capacity = $partner = $content = $target = "";
$createOrUpdate = true;

if (isset($_GET['id']))
    {
        $atelier = $controleur->getAtelier($_GET['id'],'ATELIER');
        if($desc = $atelier->fetch_assoc())
            {     
                $AtelierExist = true;
            }
        else
            {
                $AtelierExist = false;
            }
    }

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["action"] == 'Delete')
            {echo test_input($_POST["fid"]);
                $controleur->deleteAtelier(test_input($_POST["fid"]),'ATELIER');
                header('Location: ViewListAteliers.php');
            }
        else
            {
                if (empty($_POST["ftitle"])) {
                    $titleErr = "title is required";
                    $createOrUpdate = false;
                } else {
                    $title = test_input($_POST["ftitle"]);
                }

                if (empty($_POST["ftheme"])) {
                    $theme = "";
                } else {
                    $theme = test_input($_POST["ftheme"]);
                }
                
                if (empty($_POST["fnotes"])) {
                    $notes = "";
                } else {
                    $notes = test_input($_POST["fnotes"]);
                }
                
                if (empty($_POST["fplace"])) {
                    $placeErr = "Place is required";
                    $createOrUpdate = false;
                } else {
                    $place = test_input($_POST["fplace"]);
                }
                
                if (empty($_POST["fduration"])) {
                    $durationErr = "Duration is required";
                    $createOrUpdate = false;
                } else {
                    $duration = test_input($_POST["fduration"]);
                }
                if (empty($_POST["fresume"])) {
                    $resume = "";
                } else {
                    $resume = test_input($_POST["fresume"]);
                }
                if (empty($_POST["fcapacity"])) {
                    $capacityErr = "Capacity is required";
                    $createOrUpdate = false;
                } else {
                    $capacity = test_input($_POST["fcapacity"]);
                }
                if (empty($_POST["fpartner"])) {
                    $partner = "";
                } else {
                    $partner = test_input($_POST["fpartner"]);
                }
                if (empty($_POST["fcontent"])) {
                    $content = "";
                } else {
                    $content = test_input($_POST["fcontent"]);
                }
                if (empty($_POST["ftarget"])) {
                    $target = "";
                } else {
                    $target = test_input($_POST["ftarget"]);
                }
                
                if($createOrUpdate)
                    {
                        if(empty($_POST["fid"]))
                            {
                                $controleur->createAtelier($title,$theme,date("Y-m-d"),
                                $notes,$place
                                ,$duration, $resume, $capacity,
                                $partner,$target,$content,'ATELIER');

                                header('Location: ViewListAteliers.php');
                            }
                        else
                            {
                                $controleur->updateAtelier(test_input($_POST["fid"]),$title,
                                $theme,date("Y-m-d"),$notes,$place
                                , $duration, $resume, $capacity,$partner,
                                $target,$content,'ATELIER');

                                $atelier = $controleur->getAtelier($_POST["fid"],'ATELIER');
                                if($desc = $atelier->fetch_assoc())
                                    {     
                                        $AtelierExist = true;
                                    }
                                else
                                    {
                                        $AtelierExist = false;
                                    }
                            }
                    }
            }
    }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function getHtmlTitle()
{
    global $AtelierExist;
    global $desc;
    if($AtelierExist)
        {
            return 'Atelier '.$desc["titre"].'<p style="font-size: 10pt;">ID:'.$desc["id"].'</p>';
        }else
        { 
            return 'New Atelier';
        }
}

function getFieldAsText($text)
{
    global $AtelierExist;
    global $desc;
    if(!$AtelierExist)
        {
            return '';
        }
    else
        {
            return $desc[$text];
        }
}

?>

<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Ateliers</title>
    <meta name="description" content="Atelier">
    <meta name="author" content="SitePoint">
    <link rel="stylesheet" type="text/css" href="viewatelier.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                                    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
    integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                                    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
    <a type="button" class="btn btn-default" aria-label="Left Align" href="ViewListAteliers.php">Back to the list</a>
    </div>
    </div>
    <form class="well col-lg-6 colo-lg-offset-4 col-md-7 col-md-offset-3
 col-xs-8 col-xs-offset-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
    <legend class="title"><?php echo getHtmlTitle(); ?></legend>
    <div class="form-group">
    <label for="texte">Title : </label>
    <span class = "error">* <?php global $titleErr; echo $titleErr; ?> </span>
<input name="ftitle" type="text" class="form-control" value=<?php echo '"'.getFieldAsText("titre").'"' ?>/>
                                                        
                                                        </div>
                                                        
                                                        <div class="form-group" id="fg1">
                                                        <label for="select">Theme : </label>
                                                        <select name="ftheme" class="form-control" >
                                                        <option <?php echo (strcmp(getFieldAsText("theme"),'Physics') === 0 ? 'selected="selected"' : ''); ?> >Physics</option>
<option <?php echo (strcmp(getFieldAsText("theme"),'Mathematics') === 0 ? 'selected="selected"' : ''); ?>>Mathematics</option>
<option <?php echo (strcmp(getFieldAsText("theme"),'Chemistry') === 0 ? 'selected="selected"' : ''); ?>>Chemistry</option>
<option <?php echo (strcmp(getFieldAsText("theme"),'Computer Science') === 0 ? 'selected="selected"' : '') ?>>Computer Science</option>
</select>
</div>

<div class="form-group" id="fg2">
                                                        <label for="textarea">Notes : </label>
                                                        <textarea name="fnotes" type="textarea" class="form-control" value=<?php echo '"'.getFieldAsText("remarque").'"' ?>></textarea>
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group" id="fg3">
                                                        <span class = "error">* <?php global $placeErr; echo $placeErr; ?> </span>
                                                        <label for="texte">Place : </label>
                                                        <input name="fplace" type="text" class="form-control" value=<?php echo '"'.getFieldAsText("lieu").'"' ?>/>
                                                        </div>
                                                        
                                                        <div class="form-group" id="fg4">
                                                        <span class = "error">* <?php global $durationErr; echo $durationErr; ?> </span>
                                                        <label for="text">Duration : </label>
                                                        <div class="input-group">
                                                        <input name="fduration" type="time" class="form-control" style="text-align:left" value=<?php echo '"'.getFieldAsText("duree").'"' ?>/>
                                                        <span class="input-group-addon">minutes</span> 
                                                        </div>
                                                        </div>
                                                        
                                                        <div class="form-group" id="fg5">
                                                        <label for="textarea">For short : </label>
                                                        <textarea name="fresume" type="textarea" class="form-control" value=<?php echo '"'.getFieldAsText("resume").'"' ?>></textarea>
                                                        </div>
                                                        
                                                        <div class="form-group" id="fg6">
                                                        <span class = "error">* <?php global $capacityErr; echo $capacityErr; ?> </span>
                                                        <label for="text">Capacity : </label>
                                                        <input name="fcapacity" type="text" class="form-control" value=<?php echo '"'.getFieldAsText("capacite").'"' ?>></input>
                                                        </div>
                                                        
                                                        <div class="form-group" id="fg7">
                                                        <label for="textarea">Partners : </label>
                                                        <input name="fpartner" type="text" class="form-control" value=<?php echo '"'.getFieldAsText("partenaires").'"' ?></textarea>
                                                        </div>
                                                        
                                                        <div class="form-group" id="fg8">
                                                        <label for="text">Target : </label>
                                                        <input name="ftarget" type="text" class="form-control" value=<?php echo '"'.$desc["public_vise"].'"' ?>></input>
                                                        </div>
                                                        
                                                        <div class="form-group" id="fg9">
                                                        <label for="textarea">Contents : </label>
                                                        <textarea name="fcontent" type="textarea" class="form-control" value=<?php echo '"'.getFieldAsText("contenu").'"' ?>></textarea>
                                                        </div>
                                                        <div class="alert alert-block alert-danger" style="display:none">
                                                        <h4>Error !</h4>
                                                        Some fields are non-consistent.
                                                        </div>
                                                        <div style="display: inline-block;">
                                                                                                               <input name="fid" type="hidden" value=<?php echo '"'.(getFieldAsText("id")).'"'; ?>/>
                                                        <input name="action" type="submit" value=<?php echo '"'.($AtelierExist ? 'Update' : 'Create').'"'; ?>/>
<?php echo ($AtelierExist ? '<input name="action" type="submit" value="Delete"/>' : ''); ?>
</div>
</form>

</body>
</html>