<?php session_start();?>
<?php require_once("header.php");?>
<title>First</title>
</head>

<body style= "background-image:url('ques.jpg');background-repeat:no-repeat;background-size:100%;">
<?php 
      require_once("config.php");
      require_once("index.php");
      $cn = mysqli_connect(HOST , USER_NAME , USER_PW , DB); 
      mysqli_set_charset($cn, "utf8");

      $duration=300;
      $_SESSION["start"]=time();
      $_SESSION["duration"]=$duration;
      $sid   = $_SESSION['studentid'];
      $level = $_SESSION['level'];  
      $subj  = $_SESSION['subj'];
      
      
      $quisid=0;//questionid
      $onee=$twoo=$threee=$fourr='';
      $qid= $_SESSION['quizid']; //quiz id
 
       $qr= "SELECT first,answer1 FROM quizquest WHERE quiz_id = $qid;";
       $rslt = mysqli_query($cn , $qr); 
       while($row = mysqli_fetch_row($rslt))
         {           
               
              
               $quisid= $row[0] ;
                $anss=$row[1];
         }
         
     
      //condition 3ala el anss 3lshan check egabto{}
      
      if ($quisid==NULL) 
     {    
      $rslt = mysqli_query($cn , "SELECT question,answer1,answer2,answer3,answer4,correctAnswer,id FROM $subj Where
      level = '$level'
      ORDER BY RAND()
      LIMIT 1;"); 
       while($row = mysqli_fetch_row($rslt))
       {
       //var_dump($row);
       $ques= $row[0] ;
       $ans1=$row[1]; 
       $ans2=$row[2];
       $ans3=$row[3];
       $ans4=$row[4];
       $correct=$row[5];
       $quisid=$row[6];
       }  
     
       
       $rslt = mysqli_query($cn , "UPDATE quizquest
       SET first = $quisid 
       WHERE  quiz_id = $qid ;");

     }
      else 
     { 
      $rslt = mysqli_query($cn , "SELECT question,answer1,answer2,answer3,answer4,correctAnswer FROM $subj Where
      level = '$level' && id = $quisid;"); 
        while($row = mysqli_fetch_row($rslt))
          {
          //var_dump($row);
          $ques= $row[0] ;
          $ans1=$row[1]; 
          $ans2=$row[2];
          $ans3=$row[3];
          $ans4=$row[4];
          $correct=$row[5];
          }
          
          

           switch( $anss)
          {
          case 'answer1':
             {  
              $onee='checked';
              break;
             }
          case 'answer2':
             {
              $twoo='checked';
              break;
             }
          case 'answer3':
             {
              $threee='checked';
              break;
             }
 
          case 'answer4':
             {
              $fourr='checked';
              break;
             }
 
          default:
             {
              break;
             }

          }
        

     }


     
        
      $ans="";
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
       $ans = test_input($_POST["corr"]);
      } 
      

          



      ?>
         
         

          
         
<form method="post" action="count.php" class="needs-validation";novalidate>
<div class="m-4"; align="center">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">السؤال الاول</label>
    <div class="col-sm-10">
    <input class="form-control" name="name" type="text" placeholder="<?php echo $ques?>" readonly>
    
    </div>
  </div>

  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">الاختيارات</legend>
      <div class="col-sm-10 ; form-group row">
        
        
        <div class="form-check">
          <input class="form-check-input" type="radio" name="corr" id="gridRadios1" value="answer1" <?php echo $onee?> >
          <label class="form-check-label" for="gridRadios1">
           <?php  echo $ans1 ;?>
          </label>
        </div>
        
        <div class="form-check">
          <input class="form-check-input" type="radio" name="corr" id="gridRadios2" value="answer2" <?php echo $twoo?>>
          <label class="form-check-label" for="gridRadios2">
          <?php  echo $ans2 ;?>
          </label>
        </div>
       
        <div class="form-check">
          <input class="form-check-input" type="radio" name="corr" id="gridRadios3" value="answer3" <?php echo $threee?>>
          <label class="form-check-label" for="gridRadios3">
          <?php  echo $ans3 ;?>
          </label>
        </div>
       
        <div class="form-check">
          <input class="form-check-input" type="radio" name="corr" id="gridRadios3" value="answer4" <?php echo $fourr ?> >
          <label class="form-check-label" for="gridRadios4">
          <?php  echo $ans4 ;?>
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <br> 
  




 
  <div class="form-group row" ;align="center">
    <div class="col-sm-10">
     
      <button class="btn btn-primary"  type="submit">السؤال التالي</button>
      
     
    </div>
  </div>
  </div>
  
</form>


  <?php
      
         $_SESSION['ans']=$correct;
         $_SESSION['page']="first";
         $_SESSION['subj']=$subj;
         $_SESSION['studentid']=$sid;
         $_SESSION['level']=$level;
         mysqli_close($cn);
         
         

      ?>
<?php require_once("footer.php");?>