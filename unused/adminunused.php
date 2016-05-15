</div> <!-- /container -->


<div class='margin-bottom-1em overflow-hidden'>
    <div id='read-events' class='btn btn-primary pull-right display-none'>
        <span class='glyphicon glyphicon-list'></span> Read Events
    </div>

    <div id='create-event' class='btn btn-primary pull-right'>
        <span class='glyphicon glyphicon-plus'></span> Create Event
    </div>

    <!-- this is the loader image, hidden at first -->
    <div id='loader-image'><img src='images/ajax-loader.gif' /></div>
</div>
</form>
<script src="libs/js/jquery.js"></script>

<!-- bootstrap JavaScript -->
<script src="libs/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="libs/js/bootstrap/docs-assets/js/holder.js"></script>
<script type='text/javascript'>
    function changePageTitle(page_title){
        // change page title
        $('#page-title').text(page_title);

        // change title tag
        document.title=page_title;
    }
</script>
<script type='text/javascript'>
    $(document).ready(function(){

        $('#create-event').click(function(){
            // change page title
            changePageTitle('Create Event');

            // show a loader image
            $('#loader-image').show();

            $('#create-event').hide();

            $('#read-events').show();

            // fade out effect first
            $('#page-content').fadeOut('slow', function(){
                $('#page-content').load('create_event.php', function(){

                    // hide loader image
                    $('#loader-image').hide();

                    // fade in effect
                    $('#page-content').fadeIn('slow');
                });
            });
        });
    });

    $(document).on('submit', '#create-event-form', function() {

        // show a loader img
        $('#loader-image').show();

        // post the data from the form
        $.post("create.php", $(this).serialize())
            .done(function(data) {

                // show create product button
                $('#create-event').show();

                // hide read products button
                $('#read-events').hide();

                // 'data' is the text returned, you can do any conditions based on that
                showEvents();
            });

        return false;
    });


    $('#loader-image').show();
    showEvents();

    $('#read-events').click(function(){

        // show a loader img
        $('#loader-image').show();

        $('#create-event').show();

        $('#read-events').hide();

        showEvents();
    });

    function showEvents(){

        // change page title
        changePageTitle('Read Events');

        // fade out effect first
        $('#page-content').fadeOut('slow', function(){
            $('#page-content').load('read.php', function(){
                // hide loader image
                $('#loader-image').hide();

                // fade in effect
                $('#page-content').fadeIn('slow');
            });
        });
    }


    $(document).on('click', '.edit-btn', function(){

        // change page title
        changePageTitle('Update Event');

        var event_id = $(this).closest('td').find('.event-id').text();

        // show a loader image
        $('#loader-image').show();

        $('#create-event').hide();

        $('#read-events').show();

        // fade out effect first
        $('#page-content').fadeOut('slow', function(){
            $('#page-content').load('update_form.php?event_id=' + event_id, function(){
                // hide loader image
                $('#loader-image').hide();

                // fade in effect
                $('#page-content').fadeIn('slow');
            });
        });
    });
</script>