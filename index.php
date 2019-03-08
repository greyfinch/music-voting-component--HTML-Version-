<html>
<head>
<title>Music Portal</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<script src="bower_components/howler.js/dist/howler.core.min.js"></script>

<script>
    let playBtn = '<button onclick="playAudio()" class="btn btn-primary" style="width:100%"><i class="fa fa-play"></i></button>';
    let pauseBtn = '<button onclick="pauseAudio()" class="btn btn-primary" style="width:100%"><i class="fa fa-pause"></i></button>';
    let voteBtn = '<button class="btn btn-warning" style="width:100%"><i class="fa fa-check"></i> Vote</button>';

    var sound = new Howl({
        src: ['greater.mp4'],
        onload: () => {
            // document.getElementById("duration").innerHTML = sound.duration();
            document.getElementById("controls").innerHTML = playBtn;
        },
        onplay: function() {
            setInterval(() => { 
                //set loading bar value
                let totalDuration = sound.duration();
                let totlalSecPlayed = Math.floor(sound.seek())

                convertToMins = parseInt(totlalSecPlayed/60);
                convertToSec = totlalSecPlayed % 60;
                //pad time elements with preceeding 0s
                minsPlayed = paddedTimeElement(convertToMins,2);
                secsPlayed = paddedTimeElement(convertToSec,2);
            
                document.getElementById("loading-bar").innerHTML = minsPlayed + ":" + secsPlayed;

                //calculate how many percent played
                let percentPlayed = Math.floor((totlalSecPlayed * 100)/totalDuration);

                document.getElementById("loading-bar").setAttribute("aria-valuenow", percentPlayed);
                document.getElementById("loading-bar").setAttribute("style", "width: "+percentPlayed+"%");

                document.getElementById("time").value = totlalSecPlayed;
                if(totlalSecPlayed==60) {
                    document.getElementById("vote").innerHTML = voteBtn;
                }
            }, 1000);
        },  
        onend: function (){
        
        },
        html5: true
    });

var playAudio = () => {
    sound.play();
    document.getElementById("controls").innerHTML = '';
    document.getElementById("controls").innerHTML = pauseBtn;
}

var pauseAudio = () => {
    sound.pause();
    document.getElementById("controls").innerHTML = '';
    document.getElementById("controls").innerHTML = playBtn
}

var paddedTimeElement = (elementValue,paddingLength) => {
    padValue = elementValue+'';
    return  (padValue.length<paddingLength) ? newValue = '0'+ elementValue : newValue = elementValue;
}
</script>
</head>
<body style="padding-top:20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="alert alert-info" style="text-align:center">
                    You can only vote when you have listened for 60 secs.
                </div>
            </div>
        </div>

        <div class="row">
            <input type="hidden" id="time" />
            <div class="col-lg-2 pull-right" >                
                <div id="controls"></div>
            </div>

            <div class="col-lg-5">
                <div class="progress"style="height: 30px; background-color:pink;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%; " id="loading-bar"></div>
                </div>
            </div>

            <div class="col-lg-2">
                <div id="vote"></div>
            </div>
        </div>
    
    </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>