<?php

require "loader.php";

session_start();

$Char1 = $manager -> get($_GET["c1"]);
$Char2 = $manager -> get($_GET["c2"]);



$_SESSION['Char1'] = $Char1;
$_SESSION['Char2'] = $Char2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
            function bindHover(){
                $(".opt").unbind('hover');
                $(".opt").hover(function(){
                $(this).addClass("active");
                $("#audio").attr("src", "sel.mp3");
                $("#audio")[0].play();
            }, function(){
                $(this).removeClass("active");
            })
            }

        $(document).ready(()=>{

            let commands = $(".optgroup").html();
            let currentPlayer = "chr1";
            $(".currplayer").html("Tour: " + `<?php echo $Char1 -> get_name() ?>`);

            $(".opt").hover(function(){
                $(this).addClass("active");
                $("#audio").attr("src", "sel.mp3");
                $("#audio")[0].play();
            }, function(){
                $(this).removeClass("active");
            })

            $(document).on('click', '#optatk', function(){
                showTargets();
            });
            
            $(document).on('click', '.opt.charopt', function(){
                let idtargt = $(this).attr("id");
                let idfrom = currentPlayer;
                atkTarget(idtargt, idfrom);
            });

        function switchPlayer(){
            $(".optgroup").html(commands);
            $(".optgroup").show("fast");
            bindHover();
            console.log(currentPlayer);
            if (currentPlayer == "chr1")
            {
            currentPlayer = "chr2";
            $(".currplayer").html("Turn: "+ `<?php echo $Char2 -> get_name() ?>`);
            }
            else
            {
            currentPlayer = "chr1";
            $(".currplayer").html("Turn: "+ `<?php echo $Char1 -> get_name() ?>`);
            }
        }
        
        function updateHp(){
            $.ajax({
                    url: 'updatehp.php',
                    type: "POST",
                    dataType: "html",
                    success: function(data){
                        let hpArr = data.split(',');
                        $(".c1grp").find(".chp").html(hpArr[0]);
                        $(".c2grp").find(".chp").html(hpArr[1]);
                        if (hpArr[0] <= 0)
                        {
                            alert(`<?php echo $Char2 -> get_name() ?> wins !`);
                            $(".c1grp").find(".chp").html(0);
                            window.location.href = `home.html`;
                        }
                        else if (hpArr[1] <= 0){
                            alert(`<?php echo $Char1 -> get_name() ?> wins !`);
                            $(".c2grp").find(".chp").html(0);
                            window.location.href = `home.html`;
                        }
            }});
        }

        function showCommand(idtargt, idfrom){
            
            let attacker;
            let target;
            if (idtargt == "optchr1")
            target = `<?php echo $Char1 -> get_name(); ?>`;
            else
            target = `<?php echo $Char2 -> get_name(); ?>`;
            if (idfrom == "chr1")
            attacker = `<?php echo $Char1 -> get_name(); ?>`;
            if (idfrom == "chr2")
            attacker = `<?php echo $Char2 -> get_name(); ?>`;

            $(".cmd").text(`${attacker} attacks ${target} !`);

        }

        function atkTarget(idtargt, idfrom){
            
            $(".optgroup").hide("slow");
                $.ajax({
                    url: 'attk.php',
                    type: "POST",
                    data: {"idtargt":idtargt, "idfrom":idfrom},
                    success: function(data){
                        console.log(data);
                    }
                });
            switchPlayer();
            showCommand(idtargt, idfrom);
            updateHp();
        }

        function showTargets(){
            $(".optgroup").hide("slow");
            setTimeout(() => {
            $(".optgroup").html("");
            $(".optgroup").append(`<div style="background: url('<?php echo $Char1 -> get_selsprite() ?>') 19% 56%, linear-gradient(48deg, #00204ab8 0%, #0019298c 28%, #00264000 83%);" class="opt charopt" id="optchr1">
        <div class="border"></div>
        <p><?php echo $Char1 -> get_name() ?></p>
        </div>`);
        $(".optgroup").append(`<div style="background: url('<?php echo $Char2-> get_selsprite() ?>') 19% 56%, linear-gradient(48deg, #00204ab8 0%, #0019298c 28%, #00264000 83%);" class="opt charopt" id="optchr2">
        <div class="border"></div>
        <p><?php echo $Char2 -> get_name() ?></p>
        </div>`);
        $(".optgroup").show("slow");
        bindHover();
            }, 700);
        }

        function showMaterias(){
            let charId;
            if (currentPlayer == "chr1"){
                charId = `<?php echo $Char1 -> get_id() ?>`;
            }
            else{
                charId = `<?php echo $Char2 -> get_id() ?>`;
            }
            $.ajax({
                    url: 'getmaterias.php',
                    type: "POST",
                    dataType: 'HTML',
                    data: {"charId":charId},
                    success: function(data){
                        console.log(data);
                    }
                });
        }

        showMaterias();

        })
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<audio src="" id="audio"></audio>
<iframe src="bm.mp3" loop allow="autoplay" style="display:none" id="iframeAudio">
    </iframe> 
    <div class="dlgbox"><p class="cmd"></p></div>
    <div class="c1grp">
        <img src="<?php echo 'portr-c'. $Char1 -> get_id(). '.png' ?>" alt="">

        <div class="cinfo">
            <p class="cname"><?php echo $Char1 -> get_name() ?></p>
            <img src="line.png" alt="">
            <p class="chp"><?php echo $Char1 -> get_pv() ?></p>
        </div>


    </div>
    <div class="c2grp">
    <img src="<?php echo 'portr-c'. $Char2 -> get_id(). '.png' ?>" alt="">

        <div class="cinfo">
            <p class="cname"><?php echo $Char2 -> get_name() ?></p>
            <img src="line.png" alt="">
            <p class="chp"><?php echo $Char2 -> get_pv() ?></p>
        </div>

    </div>
    <div class="cmdbox">
        <div class="optgroup">
                <div class="opt" id="optatk">
                    <div class="border"></div>
                    <p>Attack</p>
                </div>
                <div class="opt" id="optmag">
                    <div class="border"></div>
                    <p>Magic</p>
                </div>
        </div>
        <p class="currplayer"></p>
    </div>
</body>
</html>