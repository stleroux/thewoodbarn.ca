<!-- Include all compiled plugins (below), or include individual files as needed -->

{{-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> --}}

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
	{{-- <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.9/api/fnFilterClear.js"></script> --}}

<!-- Google reCaptcha -->
	<script src='https://www.google.com/recaptcha/api.js'></script>

{{-- Copy to clipboard - https://www.sitepoint.com/javascript-copy-to-clipboard/ --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js"></script>

{{-- TinyMCE Editor --}}
	{{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> --}}
	{{ Html::script('js/tinymce/tinymce.min.js') }}
	{{-- Will only add the editor to textareas that have id = wysiwyg. See post->add for example --}}
	<script>
		tinymce.init({
		  selector: '.wysiwyg',
		  branding: false,
		  plugins: [
		    'code lists advlist',
		    'link charmap hr pagebreak',
		    'wordcount',
		    'nonbreaking table contextmenu',
		    'emoticons paste textcolor colorpicker textpattern codesample'
		  ],
		  toolbar1: 'undo redo | insert | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link'
		 });
	</script>
	<script>
		tinymce.init({
			selector: '.simple',
			branding: false,
			menubar: false,
			plugins: [
				'advlist autolink lists link charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code'
			],
			toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
			content_css: '//www.tinymce.com/css/codepen.min.css'
});
	</script>

{{-- Datatables --}}
<script type="text/javascript">
	$(document).ready(function() {
		$('body .dropdown-toggle').dropdown();
		
		// Setup DataTable Defaults
		$.extend( $.fn.dataTable.defaults, {
		 fnInitComplete: function(oSettings, json) {
		 
		  // Add "Clear Filter" button to Filter
		  var btnClear = $('<button class="btnClearDataTableFilter">X</button>');
		  btnClear.appendTo($('#' + oSettings.sTableId).parents('.dataTables_wrapper').find('.dataTables_filter'));
		  $('#' + oSettings.sTableId + '_wrapper .btnClearDataTableFilter').click(function () {
		   $('#' + oSettings.sTableId).dataTable().fnFilter('');
		  });
		 }
		});


		$('#datatable').DataTable( {
			"autoWidth": false,
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


{{-- <script type="text/javascript">
// Used in Mega Menu
	$(document).ready(function(){
	    $(".dropdown").hover(            
	        function() {
	            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
	            $(this).toggleClass('open');        
	        },
	        function() {
	            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
	            $(this).toggleClass('open');       
	        }
	    );
	});
</script> --}}