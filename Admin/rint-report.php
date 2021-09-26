<?php
// Session start
session_start();
// // Silence erro reporting
// error_reporting(0);
// Import the necessary Scripts
// include('includes/dbconnection.php');
require('includes/fpdf183/fpdf.php');
// Logic for authenticated access
if (strlen($_SESSION['smaid']==0)) {
    // if not authenticated redirec to index page
  header('location:logout.php');
//   Else display this
  } else{

    // require('fpdf.php');
    
    class PDF extends FPDF
    {
    // Page header
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Title',1,0,'C');
        // Line break
        $this->Ln(20);
    }
    
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }
    
    // Instanciation of inherited class
    $pdf = new PDF();
    // $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    for($i=1;$i<=40;$i++)
        $pdf->Cell(0,10,'Printing line number '.$i,0,1);
    $pdf->Output("Doc.pdf", "I");
    














    //   Extending the FPDF Class
    // class PDF extends FPDF{
    //     // Header function
    //     public function Header(){
    //         // Set font style
    //         $this ->SetFont('Times', 'BU', 9);
    //         // Set cell Width
    //         $this->Cell(75);
    //         // Insert a cell with data
    //         $this->Cell(0, 5, "SMART FARM SYSTEM", "C");
    //         // Create / jumpt to a new line
    //         $this->Ln();
    //         // Set cell Width
    //         $this->Cell(80);
    //         // Insert a cell with data
    //         $this->Cell(0, 5, "DATA REPORT", "C");
    //         // Create / jumpt to a new line
    //         $this->Ln();
    //         // Set cell Width
    //         $this->Cell(77);
    //         // Insert a cell with data
    //         $this->Cell(30, 5, "DATE: ".date('jS \of F Y'), "C");
    //         // Create / jumpt to a new line
    //         $this->Ln();
    //         $this->Ln();
    //         }   

    //        function plant_records(){
    //         //  echo "Alfred";
    //         $pdf = new PDF();
    //         // Set the left margon
    //         $pdf ->SetLeftMargin(6);
    //         // Set font name and size
    //         $pdf ->SetFont('Times', '', 9);
    //         // Add a page to the pdf created
    //         $pdf ->AddPage();
    //         // An array for storing cell lengths
    //         $padding  = array();
    //         $i = 0;
            
    //         // Add data in each cell to the header created
    //         $pdf->Cell(strlen("ID")+5, 10, "ID", 1, 0, "C");
    //         $padding[$i]=strlen("ID")+5;
    //         $i++;
    //         $pdf->Cell(strlen("Plant Name")+10, 10, "Plant Name", 1, 0, "C");
    //         $padding[$i]=strlen("Plant Name")+10;
    //         $i++;
    //         $pdf->Cell(strlen("Max PH")+10, 10, "Max PH", 1, 0, "C");
    //         $padding[$i]=strlen("Max PH")+10;
    //         $pdf->Cell(strlen("Min PH")+10,10, "Min PH", 1, 0, "C");
    //         $i++;
    //         $pdf->Cell(strlen("Max Temp")+10, 10,"Max Temp", 1, 0, "C");
    //         $padding[$i]=strlen("Max Temp")+10;
    //         $pdf->Cell(strlen("Min Temp")+10, 10,"Min Temp", 1, 0, "C");
    //         $i++;
    //         $pdf->Cell(strlen("Nitrogen")+10, 10, "Nitrogen", 1, 0, "C");
    //         $padding[$i]=strlen("Nitrogen")+10;
    //         $i++;
    //         $pdf->Cell(strlen("Phosphorus")+10, 10,"Phosphorus", 1, 0, "C");
    //         $padding[$i]=strlen("Phosphorus")+10;
    //         $i++;
    //         $pdf->Cell(strlen("Potassium")+10, 10, "Potassium", 1, 0, "C");
    //         $padding[$i]=strlen("Potassium")+10;
    //         $pdf->Ln();
                
                
    //         // // Query the database for the data and place it in the cells of the table created 
    //         // $Conn = new mysqli("localhost", "root", "1Bervin@6154", "smart farm");
    //         // $sql = "SELECT * FROM plant_records";
    //         // $result=$Conn->query($sql);
    //         // // Fetched data is put in array form and iterated on
    //         // while($row = $result->fetch_assoc()){
    //         //     $pdf->Cell($padding[0], 10,$row['ID'],1,0, "C");
    //         //     $pdf->Cell($padding[1], 10,$row['Plant_name'],1,0, "C");
    //         //     $pdf->Cell($padding[2], 10,$row['Ph_high'],1,0, "C");
    //         //     $pdf->Cell($padding[2], 10,$row['Ph_low'],1,0, "C");
    //         //     $pdf->Cell($padding[3], 10,$row['Temp_high'],1,0, "C");
    //         //     $pdf->Cell($padding[3], 10,$row['Temp_low'],1,0, "C");
    //         //     $pdf->Cell($padding[5], 10,$row['Nitrogen'],1,0, "C");
    //         //     $pdf->Cell($padding[6], 10,$row['Phosphorus'],1,0, "C");
    //         //     $pdf->Cell($padding[7], 10,$row['Potassium'],1,0, "C");
    //         //     // A new line is created 
    //         //     $pdf->Ln();
    //         // }
            
    //         $pdf->Ln();
    //         // Set the name of the file
    //         $recordname = "Plant-Records";
    //         // Unset plant record file identifier
    //         unset($_SESSION['plantrecord']);
    //         $pdf ->Output($recordname."-".date("d-M-Y").".pdf", "I"); 

    //        }

    //        function periodic_record_print(){
    //           // Create this pdf file
    //         $pdf = new PDF();
    //         // Set table header data
    //         $pdf ->SetLeftMargin(15);
    //         // Set font
    //         $pdf ->SetFont('Times', '', 9);
    //         // Add a page 
    //         $pdf ->AddPage();
    //         // Query the database for the data needed to place in table header
    //         $sql = "SELECT * FROM description";
    //         $result=$Conn->query($sql);
    //         $padding  = array();
    //         $i = 1;
    //         // Add a cell
    //         $pdf->Cell(strlen('id')+5, 10,"ID",1,0, "C");
    //         // Iterate over the fetched data and insert in table cells
    //         while($row = $result->fetch_array()){
    //             $pdf->Cell(strlen($row['Description'])+15, 10, $row["Description"], 1, 0, "C");
    //             $padding[$i]=(strlen($row['Description'])+15);
    //             $i++;
    //         }
    //         $pdf->Ln();
    //         $fdate=$_SESSION['fromdate'];
    //                         $tdate=$_SESSION['todate'];
    //                         $sql = "SELECT * from farm_data where date(Date) between '$fdate' and '$tdate'";
    //                         // Querry the database
    //                         $result=$Conn->query($sql);
    //                         // Fetched data is collected an array and iterated on whilst adding data to the cells
    //                         while($row = $result->fetch_assoc()){
    //                             $pdf->Cell(5, 10,$row['ID'],1,0, "C");
    //                             $pdf->Cell($padding[1], 10,$row['Ph'],1,0, "C");
    //                             $pdf->Cell($padding[2], 10,$row['Temperature'],1,0, "C");
    //                             $pdf->Cell($padding[3], 10,$row['Moisture'],1,0, "C");
    //                             $pdf->Cell($padding[4], 10,$row['Nitrogen'],1,0, "C");
    //                             $pdf->Cell($padding[5], 10,$row['Phosphorus'],1,0, "C");
    //                             $pdf->Cell($padding[6], 10,$row['Potassium'],1,0, "C");
    //                             $pdf->Cell($padding[7], 10,$row['Date'],1,0, "C");
    //                             $pdf->Cell($padding[8], 10,$row['Time'],1,0, "C");
    //                             $pdf->Ln();
    //                         }
    //                         // Set the name of file too be output
    //                         $recordname = "Farm-Periodic-Report";
    //                         // Unset the document identifier
    //                         unset($_SESSION['periodic']);
    //                         $pdf ->Output($recordname."-".date("d-M-Y").".pdf", "I"); 
    //        }
      
    //        function farm_data_records_print(){
    //            // Create this pdf file
    //         $pdf = new PDF();
    //         // Set table header data
    //         $pdf ->SetLeftMargin(15);
    //         // Set font
    //         $pdf ->SetFont('Times', '', 9);
    //         // Add a page 
    //         $pdf ->AddPage();
    //         // Query the database for the data needed to place in table header
    //         $sql = "SELECT * FROM description";
    //         $result=$Conn->query($sql);
    //         $padding  = array();
    //         $i = 1;
    //         // Add a cell
    //         $pdf->Cell(strlen('id')+5, 10,"ID",1,0, "C");
    //         // Iterate over the fetched data and insert in table cells
    //         while($row = $result->fetch_array()){
    //             $pdf->Cell(strlen($row['Description'])+15, 10, $row["Description"], 1, 0, "C");
    //             $padding[$i]=(strlen($row['Description'])+15);
    //             $i++;
    //         }
    //         $pdf->Ln();
    //         $sql = "SELECT * from farm_data";
    //                     // Query the databse
    //                     $result=$Conn->query($sql);
    //                     // Fetch the data an array and iterate on the data whilst adding the data in cells
    //                     while($row = $result->fetch_assoc()){
    //                         $pdf->Cell(5, 10,$row['ID'],1,0, "C");
    //                         $pdf->Cell($padding[1], 10,$row['Ph'],1,0, "C");
    //                         $pdf->Cell($padding[2], 10,$row['Temperature'],1,0, "C");
    //                         $pdf->Cell($padding[3], 10,$row['Moisture'],1,0, "C");
    //                         $pdf->Cell($padding[4], 10,$row['Nitrogen'],1,0, "C");
    //                         $pdf->Cell($padding[5], 10,$row['Phosphorus'],1,0, "C");
    //                         $pdf->Cell($padding[6], 10,$row['Potassium'],1,0, "C");
    //                         $pdf->Cell($padding[7], 10,$row['Date'],1,0, "C");
    //                         $pdf->Cell($padding[8], 10,$row['Time'],1,0, "C");
    //                         $pdf->Ln();
    //                     }
    //                     // Set the name of the file to be be output
    //                     $recordname = "Farm-Record-Data";
    //                     $pdf ->Output($recordname."-".date("d-M-Y").".pdf", "I"); 
    //        }
      
    // }
    // Name variable for the pdf document to be produced
    // $recordname="";
    // If a record for plant records only is needed
    // if(isset($_SESSION['plantrecord'])){
        // Create a pdf and its header
       
        // }
        // else{
//             // If it's not plant records required 
//            
//             // If document needed is for a periodic outptu of data
//             if(isset($_SESSION['periodic'])){
//                 // Set the date range
//                 $fdate=$_SESSION['fromdate'];
//                 $tdate=$_SESSION['todate'];
//                 $sql = "SELECT * from farm_data where date(Date) between '$fdate' and '$tdate'";
//                 // Querry the database
//                 $result=$Conn->query($sql);
//                 // Fetched data is collected an array and iterated on whilst adding data to the cells
//                 while($row = $result->fetch_assoc()){
//                     $pdf->Cell(5, 10,$row['ID'],1,0, "C");
//                     $pdf->Cell($padding[1], 10,$row['Ph'],1,0, "C");
//                     $pdf->Cell($padding[2], 10,$row['Temperature'],1,0, "C");
//                     $pdf->Cell($padding[3], 10,$row['Moisture'],1,0, "C");
//                     $pdf->Cell($padding[4], 10,$row['Nitrogen'],1,0, "C");
//                     $pdf->Cell($padding[5], 10,$row['Phosphorus'],1,0, "C");
//                     $pdf->Cell($padding[6], 10,$row['Potassium'],1,0, "C");
//                     $pdf->Cell($padding[7], 10,$row['Date'],1,0, "C");
//                     $pdf->Cell($padding[8], 10,$row['Time'],1,0, "C");
//                     $pdf->Ln();
//                 }
//                 // Set the name of file too be output
//                 $recordname = "Farm-Periodic-Report";
//                 // Unset the document identifier
//                 unset($_SESSION['periodic']);
//                 // If the document is not  periodic nor a plant records only then output all the stored data on the database
//         } else{

//             $sql = "SELECT * from farm_data";
//             // Query the databse
//             $result=$Conn->query($sql);
//             // Fetch the data an array and iterate on the data whilst adding the data in cells
//             while($row = $result->fetch_assoc()){
//                 $pdf->Cell(5, 10,$row['ID'],1,0, "C");
//                 $pdf->Cell($padding[1], 10,$row['Ph'],1,0, "C");
//                 $pdf->Cell($padding[2], 10,$row['Temperature'],1,0, "C");
//                 $pdf->Cell($padding[3], 10,$row['Moisture'],1,0, "C");
//                 $pdf->Cell($padding[4], 10,$row['Nitrogen'],1,0, "C");
//                 $pdf->Cell($padding[5], 10,$row['Phosphorus'],1,0, "C");
//                 $pdf->Cell($padding[6], 10,$row['Potassium'],1,0, "C");
//                 $pdf->Cell($padding[7], 10,$row['Date'],1,0, "C");
//                 $pdf->Cell($padding[8], 10,$row['Time'],1,0, "C");
//                 $pdf->Ln();
//             }
//             // Set the name of the file to be be output
//             $recordname = "Farm-Record-Data";
//         }

        // }
//         // Output the file in pdf format
           
// }
// }
// $file = new PDF;
// if(isset($_SESSION['plantrecord'])){
//   $file->plant_records();
}

?>