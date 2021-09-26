<?php
// Session start
session_start();
// // Silence erro reporting
// error_reporting(0);
// Import the necessary Scripts
// include('includes/dbconnection.php');
require('includes/fpdf183/fpdf.php');
class PDF extends FPDF
{
// Page header
public function Header(){
            // Set font style
            $this ->SetFont('Times', 'BU', 9);
            // Set cell Width
            $this->Cell(75);
            // Insert a cell with data
            $this->Cell(0, 5, "SMART FARM SYSTEM", "C");
            // Create / jumpt to a new line
            $this->Ln();
            // Set cell Width
            $this->Cell(80);
            // Insert a cell with data
            $this->Cell(0, 5, "DATA REPORT", "C");
            // Create / jumpt to a new line
            $this->Ln();
            // Set cell Width
            $this->Cell(72);
            // Insert a cell with data
            $this->Cell(30, 5, "DATE: ".date('jS \of F Y'), "C");
            // Create / jumpt to a new line
            $this->Ln(25);
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
$Conn = new mysqli("localhost", "root", "1Bervin@6154", "smart farm");
$recordname;
if(isset($_SESSION['plantrecord'])){

    $pdf = new PDF('P','mm','Letter');
    // Set the left margon
    $pdf ->SetLeftMargin(20);
    // Set font name and size
    // $pdf ->SetFont('Times', '', 9);
    $pdf->AliasNbPages();
    // Add a page to the pdf created
    $pdf ->AddPage();
    $pdf ->SetFont('Times', '', 9);
    // An array for storing cell lengths
    $padding  = array();
    $i = 0;
    $pdf->Cell(15);
    // Add data in each cell to the header created
    $pdf->Cell(strlen("ID")+5, 10, "ID", 1, 0, "C");
    $padding[$i]=strlen("ID")+5;
    $i++;
    $pdf->Cell(strlen("Plant Name")+10, 10, "Plant Name", 1, 0, "C");
    $padding[$i]=strlen("Plant Name")+10;
    $i++;
    $pdf->Cell(strlen("Max PH")+10, 10, "Max PH", 1, 0, "C");
    $padding[$i]=strlen("Max PH")+10;
    $pdf->Cell(strlen("Min PH")+10,10, "Min PH", 1, 0, "C");
    $i++;
    $pdf->Cell(strlen("Max Temp")+10, 10,"Max Temp", 1, 0, "C");
    $padding[$i]=strlen("Max Temp")+10;
    $pdf->Cell(strlen("Min Temp")+10, 10,"Min Temp", 1, 0, "C");
    $i++;
    $pdf->Cell(strlen("Nitrogen")+10, 10, "Nitrogen", 1, 0, "C");
    $padding[$i]=strlen("Nitrogen")+10;
    $i++;
    $pdf->Cell(strlen("Phosphorus")+10, 10,"Phosphorus", 1, 0, "C");
    $padding[$i]=strlen("Phosphorus")+10;
    $i++;
    $pdf->Cell(strlen("Potassium")+10, 10, "Potassium", 1, 0, "C");
    $padding[$i]=strlen("Potassium")+10;
    $pdf->Ln();
        
        
    // Query the database for the data and place it in the cells of the table created 
    $Conn = new mysqli("localhost", "root", "1Bervin@6154", "smart farm");
    $sql = "SELECT * FROM plant_records";
    $result=$Conn->query($sql);
    // Fetched data is put in array form and iterated on
    while($row = $result->fetch_assoc()){
        $pdf->Cell(15);
        $pdf->Cell($padding[0], 10,$row['ID'],1,0, "C");
        $pdf->Cell($padding[1], 10,$row['Plant_name'],1,0, "C");
        $pdf->Cell($padding[3], 10,$row['Temp_high']." C",1,0, "C");
        $pdf->Cell($padding[3], 10,$row['Temp_low']." C",1,0, "C");
        $pdf->Cell($padding[2], 10,$row['Ph_high'],1,0, "C");
        $pdf->Cell($padding[2], 10,$row['Ph_low'],1,0, "C");
        $pdf->Cell($padding[4], 10,$row['Nitrogen']." mg/Kg",1,0, "C");
        $pdf->Cell($padding[5], 10,$row['Phosphorus']." mg/Kg",1,0, "C");
        $pdf->Cell($padding[6], 10,$row['Potassium']." mg/Kg",1,0, "C");
        // A new line is created 
        $pdf->Ln();
    }
    
    $pdf->Ln();
    // Set the name of the file
    $recordname = "Plant-Record";
    // Unset plant record file identifier
    unset($_SESSION['plantrecord']);
}elseif(isset($_SESSION['periodic'])){
  
    $pdf = new PDF('P','mm','Letter');
    // Set the left margon
    $pdf ->SetLeftMargin(17);
    // Set font name and size
    // $pdf ->SetFont('Times', '', 9);
    $pdf->AliasNbPages();
    // Add a page to the pdf created
    $pdf ->AddPage();
    $pdf ->SetFont('Times', '', 9);
  
    // An array for storing cell lengths
            // Query the database for the data needed to place in table header
            $sql = "SELECT * FROM description";
            $result=$Conn->query($sql);
            $padding  = array();
            $i = 1;
            // Add a cell
           
            $pdf->Ln(20);
            $pdf->Cell(strlen('ID')+5, 10,"ID",1,0, "C");
            $padding[0]=strlen('ID')+5;
            // Iterate over the fetched data and insert in table cells
            while($row = $result->fetch_array()){
                $pdf->Cell(strlen($row['Description'])+15, 10, $row["Description"], 1, 0, "C");
                $padding[$i]=(strlen($row['Description'])+15);
                $i++;
            }
            $pdf->Ln();
            $fdate=$_SESSION['fromdate'];
                            $tdate=$_SESSION['todate'];
                            $sql = "SELECT * from farm_data where date(Date) between '$fdate' and '$tdate'";
                            // Querry the database
                            $result=$Conn->query($sql);
                            // Fetched data is collected an array and iterated on whilst adding data to the cells
                            while($row = $result->fetch_assoc()){
                                $pdf->Cell($padding[0], 10,$row['ID'],1,0, "C");
                                $pdf->Cell($padding[1], 10,$row['Temperature']." C",1,0, "C");
                                $pdf->Cell($padding[2], 10,$row['Moisture']." %",1,0, "C");
                                $pdf->Cell($padding[3], 10,$row['Ph'],1,0, "C");
                                $pdf->Cell($padding[4], 10,$row['Nitrogen']." mg/Kg",1,0, "C");
                                $pdf->Cell($padding[5], 10,$row['Phosphorus']." mg/Kg",1,0, "C");
                                $pdf->Cell($padding[6], 10,$row['Potassium']." mg/Kg",1,0, "C");
                                $pdf->Cell($padding[7], 10,$row['Date'],1,0, "C");
                                $pdf->Cell($padding[8], 10,$row['Time'],1,0, "C");
                                $pdf->Ln();
                            }
                            // Set the name of file too be output
                            $recordname = "Periodic-Farm-Report";
                            // Unset the document identifier
                            unset($_SESSION['periodic']);
}else{
    $pdf = new PDF('P','mm','Letter');
    // Set the left margon
    $pdf ->SetLeftMargin(17);
    // Set font name and size
    // $pdf ->SetFont('Times', '', 9);
    $pdf->AliasNbPages();
    // Add a page to the pdf created
    $pdf ->AddPage();
    $pdf ->SetFont('Times', '', 9);
  
    // An array for storing cell lengths
            // Query the database for the data needed to place in table header
            $sql = "SELECT * FROM description";
            $result=$Conn->query($sql);
            $padding  = array();
            $i = 0;
            // Add a cell
           
            // $pdf->Ln(20);
            //  Add data in each cell to the header created
            $padding  = array();
                    $i = 1;
                    // Add a cell
                    $pdf->Cell(strlen('id')+5, 10,"ID",1,0, "C");
                    // Iterate over the fetched data and insert in table cells
                    while($row = $result->fetch_array()){
                        $pdf->Cell(strlen($row['Description'])+15, 10, $row["Description"], 1, 0, "C");
                        $padding[$i]=(strlen($row['Description'])+15);
                        $i++;
                    }
                    $pdf->Ln();
                    $fdate=$_SESSION['fromdate'];
                                    $tdate=$_SESSION['todate'];
                                    $sql = "SELECT * from farm_data";
                                    // Querry the database
                                    $result=$Conn->query($sql);
                                    // Fetched data is collected an array and iterated on whilst adding data to the cells
                                    while($row = $result->fetch_assoc()){
                                        $pdf->Cell(7, 10,$row['ID'],1,0, "C");
                                        $pdf->Cell($padding[2], 10,$row['Temperature']." C",1,0, "C");
                                        $pdf->Cell($padding[3], 10,$row['Moisture']." %",1,0, "C");
                                        $pdf->Cell($padding[1], 10,$row['Ph'],1,0, "C");
                                        $pdf->Cell($padding[4], 10,$row['Nitrogen']." mg/Kg",1,0, "C");
                                        $pdf->Cell($padding[5], 10,$row['Phosphorus']." mg/Kg",1,0, "C");
                                        $pdf->Cell($padding[6], 10,$row['Potassium']." mg/Kg",1,0, "C");
                                        $pdf->Cell($padding[7], 10,$row['Date'],1,0, "C");
                                        $pdf->Cell($padding[8], 10,$row['Time'],1,0, "C");
                                        $pdf->Ln();
                                    }
                                    // Set the name of file too be output
                                    $recordname = "Farm-Report";
                                    // Unset the document identifier
                                    unset($_SESSION['periodic']);
            //                         $pdf ->Output($recordname."-".date("d-M-Y").".pdf", "I"); 
            //        }
        }
            $pdf ->Output($recordname."-".date("d-M-Y").".pdf", "I"); 

?>