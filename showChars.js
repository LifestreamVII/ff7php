$(document).ready(()=>{

let Char1;
let Char2;

$(".btn").hide();

$.ajax({url: "fetchChrInfo.php", dataType:"json", success: function(data){
    for(let i = 0; i < data.length; i++){
        $(".optgroup").append(`<div style="background: url('${data[i]['selsprite']}') 19% 56%, linear-gradient(48deg, #00204ab8 0%, #0019298c 28%, #00264000 83%);" class="opt charopt" id="opt${i+1}">
        <div class="border"></div>
        <p>${data[i]["name"]}</p>
    </div>`);
    }
    }
}).then(function(){
    $(".opt:not(.sel)").hover(function(){
        $(this).addClass("active");
        $("#audio").attr("src", "sel.mp3");
        $("#audio")[0].play();
    }, function(){
        $(this).removeClass("active");
    });

    $("#resetbtn").click(function(){
        Char1.removeClass("sel");
        Char2.removeClass("sel");
        Char1 = null;
        Char2 = null;
        $(".btn").hide();
    })

    $("#beginbtn").click(function(){
        window.location.href = `fight.php?c1=${$(Char1).children("p").text()}&c2=${$(Char2).children("p").text()}`;
    })

    $(`.opt`).click(function(){
        if (Char1 != null && this.classList.contains("sel") == false && !Char2){
        $(this).addClass("sel");
        $(this).removeClass("active");
        $("#audio").attr("src", "sel.mp3");
        $("#audio")[0].play();
        Char2 = $(this);
        $(".btn").show("slow");
    }

    else if (!Char1){
        $(this).addClass("sel");
        $(this).removeClass("active");
        $("#audio").attr("src", "sel.mp3");
        $("#audio")[0].play();
        Char1 = $(this);
    }
    });
})
});

