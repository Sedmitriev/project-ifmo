let formEditVisit = document.forms.editVisit;
let btnEditServ = document.getElementById('addEditServ');
let parent = document.getElementById('editServ');
let sumNd = formEditVisit.sum;
let servSum = formEditVisit.querySelectorAll('.services_sum');
//console.log(servSum);
function sum(form) {
  let sumNode = form.sum;
  let servSum = form.querySelectorAll('.services_sum');
  for (let i = 0; i < servSum.length; i++) {
    sumNode.value = Number(sumNode.value) + Number(servSum[i].value);
    console.log(servSum[i].value);
  }
  console.log(sumNode.value);
  return sumNode.value;
}
//sum(formEditVisit);
btnEditServ.addEventListener('click', addService);
function addService() {
    let inputServ = parent.querySelector('.form-row');
    let cloneInput = inputServ.cloneNode(true);
    parent.appendChild(cloneInput);
    let serviceSum = cloneInput.querySelectorAll('.services_sum');
    let selectService = cloneInput.querySelectorAll('.selectService');
    let serviceCount = cloneInput.querySelectorAll('.services_count');

    for (let j = 0; j < selectService.length; j++) {
    selectService[j].addEventListener('change', function() {
    let selectOption = this.getElementsByTagName('option');
    for (let i = 0; i < selectOption.length; i++) {
      if (selectOption[i].selected) {
      let id = selectOption[i].value - 1;
      serviceSum[j].value = servJSON[id].services_price;
      sumNd.value = 0;
      serviceCount[j].value = 1;
      }
    }
    sum(formEditVisit);
  });
  }

  for (let k = 0; k < serviceCount.length; k++) {
    serviceCount[k].addEventListener('change', function() {
    let selectOption = selectService[k].getElementsByTagName('option');
    for (let i = 0; i < selectOption.length; i++) {
      if (selectOption[i].selected) {
      let id = selectOption[i].value - 1;
      serviceSum[k].value = servJSON[id].services_price * this.value;
      sumNd.value = 0;
      }
    }
    sum(formEditVisit);
  });
  }
}

$(document).ready(function() {
  $("#newCard1").click(function() {
    $("#addVisit").modal("hide");
    $("#newCard").modal("show");
    $('#datetimepicker2').datetimepicker({
        locale: 'ru',
        format: 'YYYY-MM-DD HH:mm',
    });
  });
  $("#newCard2").click(function() {
    $("#addVisit").modal("hide");
    $("#newCard").modal("show");
    $('#datetimepicker2').datetimepicker({
        locale: 'ru',
        format: 'YYYY-MM-DD HH:mm',
    });
  });
});

document.addEventListener('DOMContentLoaded', function() {
  let calendarEl = document.getElementById('calendar');

  let calendar = new FullCalendar.Calendar(calendarEl, {
    height: 800,
    plugins: [ 'interaction', 'dayGrid', 'bootstrap' ],
    firstDay: 1,
    locale: 'ru',
    today : 'Сегодня',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,dayGridWeek,dayGridDay'
    },
    themeSystem: 'bootstrap',
    dateClick: function(date, jsEvent, view) {
        $("#addVisit").modal("show");
        $('#datetimepicker1').datetimepicker({
            locale: 'ru',
            format: 'YYYY-MM-DD HH:mm',
        });

        let parent = document.getElementById('serv');
        let btnServ = document.getElementById('addServ')
        btnServ.addEventListener('click', function() {
          let elem = parent.querySelector('.form-row');        
          let clone = elem.cloneNode(true);
          parent.appendChild(clone);
          let serviceSum = clone.querySelectorAll('.services_sum');
          let selectService = clone.querySelectorAll('.selectService');
          let serviceCount = clone.querySelectorAll('.services_count');
      
          for (let j = 0; j < selectService.length; j++) {
          selectService[j].addEventListener('change', function() {
          let selectOption = this.getElementsByTagName('option');
          for (let i = 0; i < selectOption.length; i++) {
            if (selectOption[i].selected) {
            let id = selectOption[i].value - 1;
            serviceSum[j].value = servJSON[id].services_price;
            serviceCount[j].value = 1;
            }
          }
        });
        }
      
        for (let k = 0; k < serviceCount.length; k++) {
          serviceCount[k].addEventListener('change', function() {
          let selectOption = selectService[k].getElementsByTagName('option');
          for (let i = 0; i < selectOption.length; i++) {
            if (selectOption[i].selected) {
            let id = selectOption[i].value - 1;
            serviceSum[k].value = servJSON[id].services_price * this.value;
            }
          }
        });
        }
        });
      },
       eventSources: [
         {
           events: events,
         }
       ],
       eventColor: '#186e14',
       eventClick: function(info) {
       //alert( 'Номер записи - ' + info.event.id + ' Запись: ' + info.event.title);
       //$("#editVisit").modal("show");
       var visitId = {
         'id' : info.event.id
       }
       $.ajax({
        type:'POST',
        url:'/visit/set',
        dataType:'json',
        data:"id=" + JSON.stringify(visitId),
        success:function(text) {
          console.log(text);
          for (let k = 0; k < text.length - 1; k++) {
            addService();
          };
            //alert(text[i].services_id, text.length);
            document.getElementById('id').value = text[0].visits_id;
            document.getElementById('date').value = text[0].visits_date;
            document.getElementById('doctor').value = text[0].doctors_name;
            document.getElementById('medcardId').value = text[0].medcard_id;
            document.getElementById('patient').value = text[0].patients_surname + " " + text[0].patients_name + " " + text[0].patients_patronymic;
            let editServSelect = document.getElementsByClassName('editServSelect');
            for (let i = 0; i < editServSelect.length; i++) {
              let servCount = formEditVisit.querySelectorAll('.services_count');
              let servSum = formEditVisit.querySelectorAll('.services_sum');
              servCount[i].value = text[i].services_count;
              servSum[i].value = text[i].services_count * text[i].services_price;
              for (let j = 0; j < editServSelect[i].length; j++) {
                if (editServSelect[i][j].value === text[i].services_id) {
                  editServSelect[i][j].selected = true;
                }
              }
            }
          $("#editVisit").modal("show");
        }
        });
     }
  });
  calendar.render();
});
