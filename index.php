<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Spreadsheet</title>
    <meta name="description" content="">
    <meta name="author" content="Faraj Daoud">
    <meta name="keywords" content="invoice, spreadsheet, report">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="favicon.ico?v=1" type="image/ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fh-3.1.3/kt-2.3.2/r-2.2.1/sc-1.4.4/datatables.min.css"/>
    <link href="css/main.css" rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Monthly Report</h2>
            </div>
        </div>
        <div class="row">
            <div id="monthlyInvoice" class="col-sm-12">
            </div>
        </div>
        
        <div class="row summaryContainer">
            <div class="col-sm-12">
                <h2>Report Totals</h2>
            </div>

            <div class="col-sm-12">
                <span>Total Invoice: </span>
                <span class="totalInvoice"></span>
            </div>
            
            <div class="col-sm-12">
                <span>Total Cost: </span>
                <span class="totalCost"></span>
            </div>
            
            <div class="col-sm-12">
                <span>Total Gross: </span>
                <span class="totalGross"></span>
            </div>
        </div>

        <div class="modal" id="reportModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="modalContent"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fh-3.1.3/kt-2.3.2/r-2.2.1/sc-1.4.4/datatables.min.js"></script>


    <script src="js/main.js"></script>
</body>
</html>