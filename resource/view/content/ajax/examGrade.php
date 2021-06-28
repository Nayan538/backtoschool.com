<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Http/Controllers/AjaxController.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE MULTIPLE DATA ===*=== ##
if($_POST['action'] == "deleteAll")
{
    $getID = $_POST['id'];
    $deleteID = implode($getID, ",");

    $deleteExamGrade = $ajaxcontrol->deleteMultiple('ems_exam_grades', 'id', $deleteID);

    if($deleteExamGrade > 0){
        echo 1;
    } else {
        echo 0;
    }
}
## ===*=== [D]ELETE MULTIPLE DATA ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if($_POST['action'] == "insertExamGrade")
{
    $grade = $_POST['grade'];
    $point = $_POST['point'];
    $from = $_POST['from'];
    $upto = $_POST['upto'];

	#Fetch Data to Check With Current Post Data
	$columnName = $tableName = $whereValue = null;
	$columnName["1"] = "grade_name";
	$tableName = "ems_exam_grades";
	$whereValue["grade_name"] = $grade;
	$fetchExamGradeData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	if(empty($fetchExamGradeData[0]['grade_name']))
	{
		$tableName = $columnValue = null;
		$tableName = "ems_exam_grades";
		$columnValue["grade_name"] = $grade;
		$columnValue["grade_point"] = $point;
		$columnValue["marks_from"] = $from;
		$columnValue["marks_upto"] = $upto;
		$columnValue["created_at"] = date('Y-m-d H:i:s');
        $insertexamGradeData = $eloquent->insertData($tableName, $columnValue);
        
        if($insertexamGradeData['LAST_INSERT_ID'] > 0) {
            echo 1;
        }
	}
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
if($_POST['action'] == "loadExamGrade")
{
    $fetchexamGradeData = $ajaxcontrol->fetchAsc('ems_exam_grades', 'grade_name');
    
    if(!empty($fetchexamGradeData))
    {
        $n = 1;
        foreach($fetchexamGradeData AS $eachRow)
        {
            echo '
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="form-check-input rowID" value="'. $eachRow['id'] .'" style="width:18px; height:18px; margin-top: -10px;">
                </td>
                <td>'. $n .'</td>
                <td class="font-weight-bold">'. $eachRow['grade_name'] .'</td>
                <td class="font-weight-bold text-success">'. $eachRow['grade_point'] .'</td>
                <td>'. $eachRow['marks_from'] .'</td>
                <td>'. $eachRow['marks_upto'] .'</td>
            </tr>
            ';
            $n++;
        }
    }
}
## ===*=== [F]ETCH DATA ===*=== ##
?>