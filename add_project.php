<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <title>web zero</title>
   <link rel='stylesheet' href='css/bootstrap.min.css' />
   <link rel='stylesheet' href='css/style.css' />

</head>

<body>
   <div class="container">
      <form method="post" action="project.controller.php">
         <input type="hidden" name="action" value="add-project">
         <h1>Add Project</h1>

         <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <div class="label">
                  Name
               </div>

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <input type="text" name="Name">

            </div>

         </div>
         <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <div class="label">
                  StartDate
               </div>

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <input type="date" name="StartDate">

            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <div class="label">
                  EndDate
               </div>

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <input type="date" name="EndDate">

            </div>


         </div>

         <div class="row">


            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <div class="label">
                  Cost
               </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <input type="number" name="Cost" min="0" step=any>

            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <div class="label">
                  Hours/Day
               </div>


            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <input type="number" name="HoursperDay" step="1" min="1" max="24">
            </div>
         </div>


         <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <div class="label">
                  deliverables
               </div>

            </div>


            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <select multiple size="4" id="select" style="width:180px" name="deliverables[]">

               </select>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <input type="text" id="deliverable">
            </div>
            <div class="btn btn-primary" onclick="addDeliverables()"> Add deliverable </div>
         </div>



         <!--container-fluid (all page)-->

         <div class="row">
            <div class="col-9">
               <input class="btn btn-danger float-right m-5" style="height: 40px" value="Add Project " type="submit">
            </div>
         </div>


      </form>
   </div>

   <script src="js/jquery.min.js"></script>

   <script src="js/bootstrap.min.js"></script>

   <script src="js/js.js"></script>
</body>


</html>


<!-- 
large screens       lg
medium screens      md
small screen        sm
extra small screen  xs



-->