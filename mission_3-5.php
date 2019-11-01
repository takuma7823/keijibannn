<html>
    <head>
    <title>mission_3-5</title>
    <meta charset = "utf-8">
    </head>
    <body>
<?php
    
    $filename = "mission_3-5.txt";
    
    
    //投稿機能
    if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["password"])){
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $password = $_POST["password"];
        $date = date("Y/m/d/H:i:s");
        //通常投稿
        if (empty($_POST['editNo'])){
            if (file_exists($filename)) {
            $num = count(file($filename)) + 1;
        } else {
            $num = 1;
        }
        $newdata = $num."<>".$name."<>".$comment."<>".$date."<>".$password."<>";
        $fp = fopen($filename,"a");
        fwrite($fp,$newdata."\n");
         fclose($fp);
        //編集投稿
        }else{
            $editNo = $_POST['editNo'];
            $ret_array = file($filename);
            $fp = fopen($filename, "w");
           foreach ($ret_array as $line) {
                $data = explode("<>", $line);
                
                if ($data[0] == $editNo) {
                    fwrite($fp, $editNo."<>".$name."<>".$comment."<>".$date."<>".$password."<>"."\n");
                } else {
                    fwrite($fp, $line);
                }
            }
            fclose($fp);
        }
    }
    
    if(!empty($_POST["delete"]) && !empty($_POST["delpass"])){//削除機能
        $delete = $_POST["delete"];
        $delpass = $_POST["delpass"];
        $filedata = file($filename);
        $fp2 = fopen($filename, "w");
        
        foreach($filedata as $value){
            $passdata = explode("<>",$value);
            if($delete == $passdata[0] && $delpass == $passdata[4]){//削除用コード
                
                }else {//元のデータを書き込む
                    fwrite($fp2,$value);
                    }
            
            }
        fclose($fp2);
    }//削除機能終わり
    //フォームに名前とコメントを表示
    if(!empty($_POST["edit"])){
        $edit = $_POST["edit"];
        $editpass = $_POST["editpass"];
        $filedata = file($filename);
        foreach($filedata as $value){
            $editdata = explode("<>",$value);
            if($editdata[4] == $editpass && $edit == $editdata[0]){
        
                $editnumber = $editdata[0];
                $editname = $editdata[1];
                $editcomment = $editdata[2];
                
            
            }
        }
    }
    
    
    
    
    ?>

<form method = "post" action = "mission_3-5.php" >
    <input  name = "name" type = "text" placeholder = "名前" value="<?php if(isset($editname)) {echo $editname;} ?>"> <br/>
    <input  name = "comment" type = "text" placeholder = "コメント"value="<?php if(isset($editcomment)) {echo $editcomment;} ?>"><br/>
    <input name = "password" type = "text" placeholder = "パスワード入力">
    <input name = "btn" type = "submit"><br/>
    <input name = "editNo" type = "hidden" placeholder = "番号入力" value="<?php if(isset($editnumber)) {echo $editnumber;} ?>">

</form>
<form method = "post" action = "mission_3-5.php" >
    <input name = "delete" type = "text" placeholder = "削除対象番号" ><br/>
    <input name = "delpass" type = "text" placeholder = "パスワード入力">
    <input name = "deletebtn" type = "submit" value = "削除" > <br/>
</form>
<form method = "post" action = "mission_3-5.php" >
    <input name = "edit" type = "text" placeholder = "編集対象番号"><br/>
    <input name = "editpass" type = "text" placeholder = "パスワード入力">
    <input name = "editbtn" type = "submit" value = "編集"> <br/>
</form>

<?php
    $filename = "mission_3-5.txt";
    //下部にデータを表示
    if(file_exists($filename)){
        $array = file($filename);
        
        
        foreach($array as $value){
            $results = explode("<>", $value);
            echo $results[0];
            echo $results[1];
            echo $results[2];
            echo $results[3]."<br>";
        }
        
    }
    ?>









</body>



</html>
