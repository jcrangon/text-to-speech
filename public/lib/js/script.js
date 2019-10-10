function FaireClignoterSousTitre (){
    $('#clignote h5').fadeOut(900).delay(300).fadeIn(800).delay(2000);
}

jQuery(document).ready(function( $ ) {

    $(window).scroll(function() {
        $('.si').each(function() {
            var imagePos = $(this).offset().top;

            var topOfWindow = $(window).scrollTop();
            if (imagePos < topOfWindow + 400) {
                $(this).addClass("slideUp");
            }
        });
    });
    //$('#headerwrap h1').fadeIn(100);
    $('#headerwrap h1').slideDown('5000');
    $('#headerwrap h3').slideDown('8000');
    $('#headerwrap2 h1').slideDown('5000');
    $('#headerwrap2 h5').slideDown('8000');
    $('#toTTS').fadeIn(4000);
    $('#toSTT').fadeIn(4500);

    //Faire clignoter le sous titre
    setInterval('FaireClignoterSousTitre()',4000);

    //page frontend TTS
    if(null!==document.getElementById('api_data_voice')){
        //requete pour récuperer la liste json des voix
        $.ajax({
            url: "https://gateway-lon.watsonplatform.net/text-to-speech/api/v1/voices",
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Basic " + btoa("apikey:VlX2pXSkSRzvsicpjPgqCaEfIG3DUGQYJNeOHN9XvTo1"));
            },
            type: 'GET',
            dataType: 'json',
            contentType: 'application/json',
            processData: false,
            data: {},
            success: function (data) {
                let sortable = [];
                let finalVoiceList=[];
                let optionList="";
                let counter=0;
                //creation d'un tableau de strings contenant les voix contenues dans l'objet json data.voices
                for (const [key, value] of Object.entries(data.voices)) {
                    //console.log(value.name);
                    sortable.push([value.name, "Lang: "+value.language, "Gender:"+value.gender]);
                }
                //console.log(sortable);

                //tri du tableau en fonction de la LANGUE parlée
                sortable.sort().forEach(function(voice){
                    let nom=voice[0].split('_')[1];
                    finalVoiceList.push([nom,voice[0],voice[1],voice[2]])
                });
                //console.log(finalVoiceList);

                //creation des options de la dropdown list contenant permettant la selection d'une voix et d'une langue
                finalVoiceList.forEach(function(voice){
                    if(counter===0){
                        optionList+='<option value="'+voice[1]+'" selected>'+voice[0]+' - '+voice[2]+' - '+voice[3]+'</option>';
                    }
                    else{
                        optionList+='<option value="'+voice[1]+'">'+voice[0]+' - '+voice[2]+' - '+voice[3]+'</option>';
                    }
                    counter++;
                });

                //insertion des options dans l'element select
                $('#api_data_voice').html(optionList);
            },
            error: function(error){
                console.log("Cannot get Voice data "+error);
            }
        });
    }

    //faire apparaitre le bouton de lecture lorsqu'il y a des caractères présents dans le textarea
    //et le faire disparaitre dans le cas contraire.
    $('#api_data_text').on("keyup",function(){
        if($(this).val()===''){
            $('#playBtn').fadeOut('fast');
            $('#audioPlayer').slideUp('fast');
        }
        else{
            $('#playBtn').fadeIn('slow');
        }
    });

    //faire apparaitre le bouton de lecture lorsque l'utilisateur change de voix
    //et que la textarea n'est pas vide
    $('#api_data_voice').on("change", function(){
       if($('#api_data_text').val()!==''){
           $('#playBtn').fadeIn('slow');
       }
    });

    //click sur le bouton de lecture
    $('#playBtn').on('click', function(){
        $("#wait1").fadeIn('100');
        let text = $('#api_data_text').val();
        let voice = $('#api_data_voice').val();
        let url = encodeURI('https://gateway-lon.watsonplatform.net/text-to-speech/api/v1/synthesize?accept=audio/ogg;codecs=opus&download=true&text='+text+'&voice='+voice);
        $.ajax({
            url: url,
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Basic " + btoa("apikey:VlX2pXSkSRzvsicpjPgqCaEfIG3DUGQYJNeOHN9XvTo1"));
            },
            type: 'GET',
            data: {
            },
            xhrFields: {
                responseType: 'blob',
            },
            success: function (data,status) {
                $("#wait1").fadeOut('fast');
                let bloburl=window.URL.createObjectURL(data);
                $('#audioPlayer').slideDown('3000');
                $('#audioPlayer').attr('src', bloburl);
                $('#playBtn').fadeOut('fast');
            },
            error: function(error){
                console.log("Cannot get Voice data "+error);
            }
        });
    });



    //page backend TTS
    if(null!==document.getElementById('api_data_back_voice')){

        //faire apparaitre le bouton de lecture lorsqu'il y a des caractères présents dans le textarea
        //et le faire disparaitre dans le cas contraire.
        $('#api_data_back_text').on("keyup",function(){
            if($(this).val()===''){
                $('#playBtn').fadeOut('fast');
                $('#audioPlayer').slideUp('fast');
            }
            else{
                $('#playBtn').fadeIn('slow');
            }
        });
    }
});