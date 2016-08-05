function attributeyChange1(){
    radio = document.getElementsByName('data[Member][attributePlan]')
    if(radio[0].checked) {
        //フォーム
        document.getElementById('firstBox1').style.display = "";
        document.getElementById('firstBox3').style.display = "";
        document.getElementById('firstBox4').style.display = "";
        document.getElementById('firstBox5').style.display = "";
        document.getElementById('firstBox6').style.display = "";
        document.getElementById('firstBox7').style.display = "";
        document.getElementById('firstBox8').style.display = "";
        document.getElementById('firstBox9').style.display = "";
        document.getElementById('firstBox10').style.display = "";
        document.getElementById('firstBox11').style.display = "";
        document.getElementById('secondBox1').style.display = "none";
        document.getElementById('secondBox2').style.display = "none";
        document.getElementById('secondBox3').style.display = "none";
        document.getElementById('secondBox4').style.display = "none";
        document.getElementById('secondBox5').style.display = "none";
    }else if(radio[1].checked) {
        //フォーム
        document.getElementById('firstBox1').style.display = "none";
        document.getElementById('firstBox3').style.display = "none";
        document.getElementById('firstBox4').style.display = "none";
        document.getElementById('firstBox5').style.display = "none";
        document.getElementById('firstBox6').style.display = "none";
        document.getElementById('firstBox7').style.display = "none";
        document.getElementById('firstBox8').style.display = "none";
        document.getElementById('firstBox9').style.display = "none";
        document.getElementById('firstBox10').style.display = "none";
        document.getElementById('firstBox11').style.display = "none";
        document.getElementById('secondBox1').style.display = "";
        document.getElementById('secondBox2').style.display = "";
        document.getElementById('secondBox3').style.display = "";
        document.getElementById('secondBox4').style.display = "";
        document.getElementById('secondBox5').style.display = "";
    }
}