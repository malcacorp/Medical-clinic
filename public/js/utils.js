const nextPatientForm = () => {
  document.getElementById("divPatientForm").style.visibility = "hidden";
  document.getElementById("divConditionForm").style.visibility = "visible";
}

const backMedicalForm = () => {
  document.getElementById("divPatientForm").style.visibility = "visible";
  document.getElementById("divConditionForm").style.visibility = "hidden";
}

function getDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 

  today = yyyy + '-' + mm + '-' + dd;
  console.log(today);
  document.getElementById("calendar").value = today;
}

const handleChangeRadio = (el) => {
  console.log(el.value)
  if(el.value == "no"){
    document.getElementById("calendar-div").style.display = "none"
    document.getElementById("no-buttons").style.display = "block"
    document.getElementById("yes-buttons").style.display = "none"
    // document.getElementById("medical-condition-div").style.display = "none"
    // document.getElementById("finish-button").style.display = "block"
    document.getElementById("webpage-button").style.display = "block"
    // document.getElementById("schedule-appointment").style.display = "none"
  } else {
    document.getElementById("calendar-div").style.display = "block"
    document.getElementById("no-buttons").style.display = "none"
    document.getElementById("yes-buttons").style.display = "block"
    // document.getElementById("medical-condition-div").style.display = "block"
    // document.getElementById("finish-button").style.display = "none"
    document.getElementById("webpage-button").style.display = "none"
    // document.getElementById("schedule-appointment").style.display = "block"
  }
}

function preview() {
  frame.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage() {
  document.getElementById('formFile').value = null;
  frame.src = "";
}