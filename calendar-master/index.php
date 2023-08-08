<?php
require_once('connect.php');


$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Full calendar PHP</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">

		<!-- FullCalendar -->
		<link href='lib/fullcalendar.min.css' rel='stylesheet' />
		<link href="css/info.css" rel="stylesheet">

		<script src='/lib/jquery.min.js'></script>
		<!-- jQuery Version 1.11.1 -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/info.js"></script>

		<!-- FullCalendar -->
		<script src='lib/moment.min.js'></script>
		<script src='lib/fullcalendar.min.js'></script>


		<!-- Custom CSS -->
		<style>
			body {
				padding-top: 70px;
				/* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
			}

			#calendar {
				max-width: 800px;
			}

			.col-centered {
				float: none;
				margin: 0 auto;
			}
		</style>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	</head>

	<body>

	
		<!-- Page Content -->
		<div class="container">

			<div class="row">

				<div class="col-lg-12 text-center">
					<h1></h1>
					<div id="calendar" class="col-centered">
					</div>
				</div>

			</div>
			<!-- /.row -->

			<!-- Modal -->
			<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" action="addEvent.php">

							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Add Event</h4>
							</div>
							<div class="modal-body">

								<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" name="title" class="form-control" id="title" placeholder="Title">
									</div>
								</div>
								<div class="form-group">
									<label for="color" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
										<option value="">Choose</option>
											<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
											<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
											<option style="color:#008000;" value="#008000">&#9724; Green</option>
											<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
											<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
											<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
											<option style="color:#9F91CC;" value="#9F91CC">&#9724; Purple</option>
											<option style="color:#CD853F;" value="#CD853F">&#9724; Peru</option>
											<option style="color:#A9A9A9;" value="#A9A9A9">&#9724; Dark grey</option>
											<option style="color:#98FB98;" value="#98FB98">&#9724; PaleGreen</option>
											<option style="color:#850791;" value="#850791">&#9724; Dark Purple</option>
											<option style="color:#F08080;" value="#F08080">&#9724; Light Coral</option>

										
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="start" class="col-sm-2 control-label">Start date</label>
									<div class="col-sm-10">
										<input type="text" name="start" class="form-control" id="start" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="end" class="col-sm-2 control-label">End date</label>
									<div class="col-sm-10">
										<input type="text" name="end" class="form-control" id="end" readonly>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" action="editEventTitle.php">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
							</div>
							<div class="modal-body">

								<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" name="title" class="form-control" id="title" placeholder="Title">
									</div>
								</div>
								<div class="form-group">
									<label for="color" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
										<option value="">Choose</option>
											<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
											<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
											<option style="color:#008000;" value="#008000">&#9724; Green</option>
											<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
											<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
											<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
											<option style="color:#9F91CC;" value="#9F91CC">&#9724; Purple</option>
											<option style="color:#CD853F;" value="#CD853F">&#9724; Peru</option>
											<option style="color:#A9A9A9;" value="#A9A9A9">&#9724; Dark grey</option>
											<option style="color:#98FB98;" value="#98FB98">&#9724; PaleGreen</option>
											<option style="color:#850791;" value="#850791">&#9724; Dark Purple</option>
											<option style="color:#F08080;" value="#F08080">&#9724; Light Coral</option>

										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox">
											<label class="text-danger">
												<input type="checkbox" name="delete"> Delete event</label>
										</div>
									</div>
								</div>

								<input type="hidden" name="id" class="form-control" id="id">


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
		<!-- /.container -->


		<?php date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	?>
		<script>

			$(document).ready(function () {

				$('#calendar').fullCalendar({

					header: {

						left: 'prev,next today',
						center: 'title',
						//right: 'month,basicWeek,basicDay'
						right: 'month,agendaWeek,agendaDay,listMonth'
					},
				
					navLinks: true,
					defaultDate: '<?php echo$date?>',
					minTime: '00:00:00',
					maxTime: '24:00:00',
					editable: true,

					eventLimit: true, // allow "more" link when too many events
					selectable: true,
					selectHelper: true,
					select: function (start, end) {

						$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
					},
					eventRender: function (event, element) {
						element.bind('dblclick', function () {
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #title').val(event.title);
							$('#ModalEdit #color').val(event.color);
							$('#ModalEdit').modal('show');
						});
					},
					eventDrop: function (event, delta, revertFunc) { // si changement de position

						edit(event);

					},
					eventResize: function (event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

						edit(event);

					},
					events: [
			<?php foreach($events as $event):
						$start = explode(" ", $event['start']);
					$end = explode(" ", $event['end']);
					if($start[1] == '00:00:00'){
					$start = $start[0];
				}else {
					$start = $event['start'];
				}
				if ($end[1] == '00:00:00') {
					$end = $end[0];
				} else {
					$end = $event['end'];
				}
			?>
					{
						id: '<?php echo $event['id']; ?>',
						title: '<?php echo $event['title']; ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						color: '<?php echo $event['color']; ?>',
					},
			<?php endforeach; ?>
			]
			});

			function edit(event) {
				start = event.start.format('YYYY-MM-DD HH:mm:ss');
				if (event.end) {
					end = event.end.format('YYYY-MM-DD HH:mm:ss');
				} else {
					end = start;
				}

				id = event.id;

				Event = [];
				Event[0] = id;
				Event[1] = start;
				Event[2] = end;

				$.ajax({
					url: 'editEventDate.php',
					type: "POST",
					data: { Event: Event },
					success: function (rep) {
						if (rep == 'OK') {
							alert('Pouvez-vous confirmer les modifications que vous avez apportées ?');
						} else {
							alert("Impossible d'enregistrer. Veuillez réessayer.");
						}
					}
				});
			}
		
	});

		</script>
<!-- Add these lines to include the libraries -->
<!-- dom-to-image.js -->

<!-- Add the buttons to your form -->
<!-- Add the "Save as Image" and "Save as PDF" buttons to your form -->
<div class="button-wrapper">
         <!-- "Save as Image" button -->
         <button class="button" id="downloadButton">Save as image</button>
         <!-- "Save as PDF" button -->
         <button class="button" id="saveAsPDFButton">Save  as PDF</button>
</div>
<div class="container">
        <div class="info alert">
              <div class="content">
                <div class="icon">
                  <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="50" height="50" rx="25" fill="white"/>
          <path d="M27 22H23V40H27V22Z" fill="#006CE3"/>
          <path d="M25 18C24.2089 18 23.4355 17.7654 22.7777 17.3259C22.1199 16.8864 21.6072 16.2616 21.3045 15.5307C21.0017 14.7998 20.9225 13.9956 21.0769 13.2196C21.2312 12.4437 21.6122 11.731 22.1716 11.1716C22.731 10.6122 23.4437 10.2312 24.2196 10.0769C24.9956 9.92252 25.7998 10.0017 26.5307 10.3045C27.2616 10.6072 27.8864 11.1199 28.3259 11.7777C28.7654 12.4355 29 13.2089 29 14C29 15.0609 28.5786 16.0783 27.8284 16.8284C27.0783 17.5786 26.0609 18 25 18V18Z" fill="#006CE3"/>
          </svg>
              </div>
                <p><option value="">Hébergement:</option>
            
                            <option style="color:#0071c5;" value="#0071c5">&#9724;  Manal Outaouchi</option>
                            <option style="color:#40E0D0;" value="#40E0D0">&#9724; Oumaima Diani</option>
                            <option style="color:#FFD700;" value="#FFD700">&#9724; Hamza Benjeloun</option>
                            <option style="color:#FF8C00;" value="#FF8C00">&#9724; Imane Khalifi</option>
                            <option style="color:#9F91CC;" value="#9F91CC">&#9724; Zayd Zidouh</option>
                            <option style="color:#6bf16b;" value="#98FB98">&#9724; Atar Benismael</option>


                        
                        </select>
                </p>
              </div>
              <button class="close">
               <svg height="18px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="#69727D" d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z"/></svg>
              </button>
            </div>
        </div>
        <div class="container">
            <div class="info alert">
                  <div class="content">
                    <div class="icon">
                      <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="50" height="50" rx="25" fill="white"/>
              <path d="M27 22H23V40H27V22Z" fill="#006CE3"/>
              <path d="M25 18C24.2089 18 23.4355 17.7654 22.7777 17.3259C22.1199 16.8864 21.6072 16.2616 21.3045 15.5307C21.0017 14.7998 20.9225 13.9956 21.0769 13.2196C21.2312 12.4437 21.6122 11.731 22.1716 11.1716C22.731 10.6122 23.4437 10.2312 24.2196 10.0769C24.9956 9.92252 25.7998 10.0017 26.5307 10.3045C27.2616 10.6072 27.8864 11.1199 28.3259 11.7777C28.7654 12.4355 29 13.2089 29 14C29 15.0609 28.5786 16.0783 27.8284 16.8284C27.0783 17.5786 26.0609 18 25 18V18Z" fill="#006CE3"/>
              </svg>
                  </div>
                    <p>	<option value="">Sales:</option>
                        <option style="color:#FF0000;" value="#FF0000">&#9724; Manal Outaouchi</option>
                        <option style="color:#008000;" value="#008000">&#9724; Oumaima Diani</option>
                        <option style="color:#CD853F;" value="#CD853F">&#9724; Hamza Benjeloun</option>
                        <option style="color:#A9A9A9;" value="#A9A9A9">&#9724; Imane Khalifi </option>
                        <option style="color:#850791;" value="#850791">&#9724; Zayd Zidouh</option>
                        <option style="color:#F08080;" value="#F08080">&#9724; Atar Benismael</option>
                  </div>
                  <button class="close">
                   <svg height="18px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="#69727D" d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z"/></svg>
                  </button>
                </div>
        </div>
<!-- Add the script below AFTER the buttons are present in the HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
  document.getElementById("downloadButton").addEventListener("click", function () {
    const calendarElement = document.getElementById("calendar");
    calendarElement.style.backgroundColor = "white"; // Set background color to white
    domtoimage.toPng(calendarElement)
      .then(function (dataUrl) {
        const link = document.createElement("a");
        link.href = dataUrl;
        link.download = "calendar.png";
        link.click();

        calendarElement.style.backgroundColor = ""; // Reset background color after the screenshot is taken
      })
      .catch(function (error) {
        console.error("Error while saving the calendar as an image:", error);
        calendarElement.style.backgroundColor = ""; // Reset background color if an error occurs
      });
  });

  document.getElementById("saveAsPDFButton").addEventListener("click", function () {
    const calendarElement = document.getElementById("calendar");

    const opt = {
      margin: 10,
      filename: "calendar.pdf",
      image: { type: "jpeg", quality: 1.0 }, // Increase the quality to 1.0 (maximum quality)
      html2canvas: { scale: 2 }, // Increase the scale to 3 for higher resolution
      jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
    };
	calendarElement.style.width = "700px"; // Adjust the width as needed

    html2pdf()
      .set(opt)
      .from(calendarElement)
      .save();
  });
</script>

<a href="logout.php" class="btn btn-info btn-lg">
                <span class="glyphicon glyphicon-log-out"></span> Log out
            </a>


			
	</body>

	</html>