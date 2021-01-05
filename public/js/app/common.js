function getStates()
{
    let countryId = $("#country_id").val();
    $.ajax({
        type:'GET',
        url: BaseUrl + '/get-states/'+countryId,
        success: function(data) {
           $("#state_id").html(data);
        }
    });
}