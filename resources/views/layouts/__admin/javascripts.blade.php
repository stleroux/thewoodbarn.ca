<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
	{{--
		Causes modal popups not too work
		Must be because bootstrap is loading somewhere else, most likely in the datatables
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	--}}

<!-- Datatable -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.13/cr-1.3.2/fc-3.2.2/fh-3.1.2/r-2.1.0/sc-1.4.2/datatables.min.js"></script>

<!-- Google reCaptcha -->
	<script src='https://www.google.com/recaptcha/api.js'></script>

{{-- TinyMCE Editor --}}
	<script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
	{{-- Will only add the editor to textareas that have id = wysiwyg. See post->add for example --}}
	<script>
		tinymce.init({
		  selector: '.wysiwyg',
		  branding: false,
		  plugins: [
		    'code',
		    'link charmap hr pagebreak',
		    'wordcount',
		    'nonbreaking table contextmenu',
		    'emoticons paste textcolor colorpicker textpattern codesample',
		    'lists advlist'
		  ],
		  advlist_bullet_styles: 'default,circle,disc,square',
		  advlist_number_styles: 'default,lower-alpha,lower-roman,upper-alpha,upper-roman',
		  toolbar1: 'undo redo | insert | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link'
		 });
	</script>
	<script>
		tinymce.init({
			selector: '.simple',
			menubar: false,
			branding: false,
			toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
  			plugins: 'code'
		});
	</script>

{{-- Datatables --}}
<script type="text/javascript">
	$(document).ready(function() {
		$('body .dropdown-toggle').dropdown();
		$('#datatable').DataTable( {
			pagingType: "full_numbers",
			oLanguage: {
         		oPaginate: {
           			sFirst: 'First',
           			sPrevious: 'Previous',
           			sNext: 'Next',
           			sLast: 'Last'
         		},
       		},
			stateSave: true,
			"columnDefs": [{
				"targets": 'no-sort',
				"orderable": false,
			}],
			<?php if (Auth::check()) { ?>
				"lengthMenu": [[<?php echo Auth::user()->rowsPerPage; ?>, 5, 10, 15, 20, 25, 50, 100], [<?php echo Auth::user()->rowsPerPage; ?>, 5, 10, 15, 20, 25, 50, 100]],
				"pageLength": <?php echo Auth::user()->rowsPerPage; ?>
			<?php } else { ?>
				"lengthMenu": [[5, 10, 15], [5, 10, 15]],
				"pageLength": 10
			<?php } ?>
		});
	} );
</script>

<!-- Make alert messages fade off the screen -->
<script type="text/javascript">
	$(document).ready(function () {
	 
	window.setTimeout(function() {
	    $(".alert").fadeTo(500, 0).slideUp(500, function(){
	        $(this).remove(); 
	    });
	}, <?php
			if (Auth::check()) { 
				echo Auth::user()->alertFadeTime;
			} else {
				echo '5000';
			}
		?>
	);
	 
	});
</script>

<script type="text/javascript">
	$(document).ready( function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>

<script type="text/javascript">
	$(function () {
  		$('[data-toggle="popover"]').popover()
	});
</script>

<script type="text/javascript">
	jQuery(document).on('click', '.mega-dropdown', function(e) {
		e.stopPropagation()
	});
</script>

{{-- Used to enable toggle of Instructions panel in Roles page--}}
<script type="text/javascript">
	$('#click_advance').click(function() {
		$('#display_advance').toggle('1000');
		$("i", this).toggleClass("fa-plus-square fa-minus-square");
		$("a", this).toggleClass("btn-info btn-primary");
	});
</script>

{{-- Can't remember what this is for --}}
{{-- <script type="text/javascript">
	document.onreadystatechange = function () {
	  var state = document.readyState
	  if (state == 'complete') {
	         document.getElementById('interactive');
	         document.getElementById('load').style.visibility="hidden";
	  }
	}
</script> --}}