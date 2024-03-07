
$(document).ready(function() {

    var banned = false;

    function containsForbiddenWord(text) {
        const pattern = /put[@a]?|g[@a]?go|t4ng ?in4?|b0b0?/i;
        return pattern.test(text);
    }

    
        
        $('#post-btn').on('click', function() {
            if(banned == false){

                var inputValue = $('#post').val()
                
                console.log(inputValue)
                if (containsForbiddenWord(inputValue)) {
                    alert('Forbidden word found!');
                    //$('#validation-result').text("Forbidden word found!");
                    banned = true;
                } else {
                    alert('No forbidden words found.');
                    //$('#validation-result').text("No forbidden words found.");
                }
            } 
            else{
                alert('You Have Been Banned');
            }
        });



})
