
<?php
  
  require('../fpdf/fpdf.php');
    
  $conn=mysqli_connect('localhost','root','');
  mysqli_select_db($conn,'furniture_system');
  
  
  class PDF extends FPDF {
      function Header(){
          $this->SetFont('Arial','B',15);
          
          //dummy cell to put logo
          //$this->Cell(12,0,'',0,0);
          //is equivalent to:
          $this->Cell(12);
          
          //put logo
          $this->Image('../assets/img/furniture.jpg',10,10,10);
          $this->Cell(100,10,'Rose Furniture Ordering System',0,1);
          $this->Cell(50,10,'Sales Reports',0,1);
          
          //dummy cell to give line spacing
          //$this->Cell(0,5,'',0,1);
          //is equivalent to:
          $this->Ln(5);
          
          $this->SetFont('Arial','B',11);
          
          $this->SetFillColor(180,180,255);
          $this->SetDrawColor(180,180,255);
          $this->Cell(45,5,'Customer Name',1,0,'',true);
          $this->Cell(30,5,'Product No',1,0,'',true);
          $this->Cell(41,5,'Tracking No',1,0,'',true);
          $this->Cell(15,5,'Price',1,0,'',true);
          $this->Cell(15,5,'Qty',1,0,'',true);
          $this->Cell(43,5,'Date Completed',1,1,'',true);
        //   $this->Cell(43,5,'Date Created',1,0,'',true);
        //   $this->Cell(43,5,'Date Approved',1,1,'',true);
        //   $this->Cell(60,5,'Address',1,1,'',true);

          
      }
      function Footer(){
          //add table's bottom line
          $this->Cell(188,0,'','T',1,'',true);
          
          //Go to 1.5 cm from bottom
          $this->SetY(-15);
                  
          $this->SetFont('Arial','',8);
          
          //width = 0 means the cell is extended up to the right margin
          $this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
      }
  }
  
  
  //A4 width : 219mm
  //default margin : 10mm each side
  //writable horizontal : 219-(10*2)=189mm
  
  $pdf = new PDF('P','mm','A4'); //use new class
  
  //define new alias for total page numbers
  $pdf->AliasNbPages('{pages}');
  
  $pdf->SetAutoPageBreak(true,15);
  $pdf->AddPage();
  
  $pdf->SetFont('Arial','',9);
  $pdf->SetDrawColor(180,180,255);
  

  if(isset($_POST['from_date']) && isset($_POST['to_date'])){
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];


      $query=mysqli_query($conn,"SELECT * FROM tbl_order_detail_items WHERE 
      date_completed BETWEEN '$from_date' AND '$to_date' 
      AND to_complete = '2' AND refund_status IN (0,1) ORDER BY order_id DESC");
   
      if(mysqli_num_rows($query) > 0){
  
        while($data=mysqli_fetch_array($query)){
            $custName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = '".$data['user_id']."' ");
            $fetchCustName = mysqli_fetch_assoc($custName);

            $full_name = $fetchCustName['first_name'] . ' ' . $fetchCustName['last_name'];

            $date_completed = date("F j, Y h:iA", strtotime($data['date_completed']));
        //   $date_approved = date("F j, Y h:iA", strtotime($data['date_approved']));
            $pdf->Cell(45,5,$full_name,1,0);   
            $pdf->Cell(30,5,$data['product_code'],1,0);          
            $pdf->Cell(41,5,$data['detail_code'],1,0);
            $pdf->Cell(15,5,$data['price'],1,0);
            $pdf->Cell(15,5,$data['quantity'],1,0);
            $pdf->Cell(43,5,$date_completed,1,1);
        //   $pdf->Cell(43,5,$date_created,1,0);
        //   $pdf->Cell(43,5,$date_approved,1,1);

      }
  
      $sql2 = mysqli_query($conn, "SELECT SUM(price * quantity) AS total_amount FROM tbl_order_detail_items WHERE to_complete = '2' AND refund_status IN (0,1) ");
      $fetch = mysqli_fetch_assoc($sql2);

      $totalAmount = $fetch['total_amount'];
      $pdf->Line(10, 40, 198, 40);
  
      $pdf->Ln(5);
      $pdf->Cell(30, 5, 'Total Amount', 1, 0);
      $pdf->Cell(30, 5, $totalAmount . ' Php', 1, 1);

  
      $start = date("F j, Y", strtotime($from_date));
      $end = date("F j, Y", strtotime($to_date));
  
      $pdf->Cell(130, 5, '', 0, 0);
      $pdf->Cell(50, 5, $start . ' to ' . $end, 0, 1, 'C');
  
  
  
      $pdf->Output();
  
      }else {
        header("Location: dashboard?export=not_found");
      }



  }


  ?>
  