<?php
function build_calendar($month, $year) {

 
     
  
     // Создание массива дней недели
     $daysOfWeek = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье');

     // инициализация первого дня месяца
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // кол дней в месяце
     $numberDays = date('t',$firstDayOfMonth);

     $dateComponents = getdate($firstDayOfMonth);

     // Имя месяца
     $monthName = $dateComponents['month'];

     // индекс дней недели от 0 до 6
     $dayOfWeek = $dateComponents['wday'];

     // Создание таблицы
     
    $datetoday = date('Y-m-d');
    
    
    
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
    
    
        
      $calendar .= "<tr>";

     // Хидер таблицы

     foreach($daysOfWeek as $day) {
          $calendar .= "<th  class='header'>$day</th>";
     } 



     $currentDay = 1;

     $calendar .= "</tr><tr>";

     //проверка столбцов на 7

     if ($dayOfWeek > 0) { 
         for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty' ></td>"; 

         }
     }
    
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

         // новый столбец при заполнение

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
     
             $calendar.="<td><h4>$currentDay  </h4>   
             <button class='btn  btn-xs' data-toggle='modal' data-target='#myModal'> Добавить событие   </button>";
 

            
           
            
          $calendar .="</td>";
       
 
          $currentDay++;
          $dayOfWeek++;

     }
     
     

     

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 

         }

     }
     
     $calendar .= "</tr>";

    $calendar .= "</table>";

     echo $calendar;

}
    
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>

        .today{

            background:yellow;
        }
        
        
        
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                     $dateComponents = getdate();
               
                     $dateComponents = getdate();
                     if(isset($_GET['month']) && isset($_GET['year'])){
                         $month = $_GET['month'];                
                         $year = $_GET['year'];
                     }else{
                         $month = $dateComponents['mon'];                
                         $year = $dateComponents['year'];
                     }
                    echo build_calendar($month,$year);
                ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Добавление событии </h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <form action="check.php" method="post"> 
            
                        <div class="form-group">
                            <label for="">Название событии</label>
                            <input  type="text"  name="event" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Важность</label>
                            <input  type="text"  name="importance" class="form-control">
                        </div>
                         <div class="form-group pull-right">
                            <button class="btn btn-primary" type="submit" name = "submit">Submit</button>
                        </div>
                   </form>
              </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  

</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  </html>
