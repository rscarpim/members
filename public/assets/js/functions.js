/* Funcoes Definidas em JavaScript. */
'use strict';


/******************************************************************************/
/* FUNCTION SECTION : Functions that allways have a return. */
/******************************************************************************/

/* 
*   Name        : FPopulateCombo
*   Objective   : Populates a Combobox with Database Information.
*   Author      : Ricardo Scarpim.
*   Date        : 12/03/2018
*   Parameters  :
*               @pUrl       : Url Responsible for bring the Data from the DataBase.
*               @pObjCombo  : The combobox DOM obj name.
* 
*   Output      : A combobox filled with the DataBase table Values. 
*/
async function FPopulateCombo($pUrl, $pController,  $pFunctionName,  pObjCombo, pFieldToValue, pFieldToFill, $pAvoid)
{    

	let formData = new FormData();

  formData.append('controller', $pController);
	formData.append('function', $pFunctionName);

  let response = await fetch($pUrl, { method: 'POST', body: formData });

  let data = await response.json();

  /* Setting the Fixed Text. */
  pObjCombo[pObjCombo.length] = new Option('Select an Option', 0);
    
  /* Populating the Combo. */
  data.forEach(function (value) {
  
      /* Checking if is the Result to Avoid. */
      if(value[pFieldToFill] !== $pAvoid)
        
        pObjCombo[pObjCombo.length] = new Option(value[pFieldToFill], value[pFieldToValue]);
  });
}




async function FSaveData($pUrl, $pController, $pFunctionName, $pData)
{    
    
    let formData = new FormData();

    formData.append('controller', $pController);
    formData.append('function',   $pFunctionName);

    

    Object.keys($pData).forEach(function(key) {

        formData.append( key, $pData[key]);
    });    


    let response = await fetch($pUrl, { method: 'POST', body: formData });

    let data = await response.json();
}




async function FCheckData($pUrl, $pController, $pFunctionName, $pData)
{

    let formData = new FormData();

    formData.append('controller', $pController);
    formData.append('function',   $pFunctionName);

    /* All the Other Data Objects to perform the Query. */
    Object.keys($pData).forEach(function(key) {

        formData.append( key, $pData[key]);
    });

    let response = await fetch('http://localhost:8888/app/helpers/helpers.php', { method: 'POST', body: formData });

    let data = await response.json();

    return data;
}





const FMsgBoxe = (pTypeMsg, pTypeTitle, pMessage, pTimer = null ) => {

    switch(pTypeMsg){

        /* Regular Message shaw*/


        /* Toast Message */ 
        case 2:

            const toast = swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              background: '#E8F6F3',
              timer: (pTimer !== null) ? pTimer : 3000,
            });

            toast({
              type: pTypeTitle,
              title: pMessage,
              background: '#E8F6F3'
            })            
            break;
    }
}




const FGenerateRender = (pStep, pSelect) => {
  
  let dt = new Date(1970, 0, 1, 0, 0, 0, 0);

  let toReturn = "";

  while (dt.getDate() == 1) {

      /* Checking the Default Text to be Setted. */
      if(FGetTimeStr(dt) === pSelect + " AM"){

        /* Creating the Render for Every 30 Minutes. */
        toReturn += `<option class="memControl" value="${FGetTimeStr(dt).substr(0, 5)}" selected>${FGetTimeStr(dt)}</option>`;

      }else
      {

        /* Creating the Render for Every 30 Minutes. */
        toReturn += `<option class="memControl" value="${FGetTimeStr(dt).substr(0, 5)}">${FGetTimeStr(dt)}</option>`;
      }
        
      dt.setMinutes(dt.getMinutes() + parseInt(pStep));
  }
    
    return toReturn;
}



/* Convert a Date format : MM/DD/YYYY to a Month, day, etc date. */
const FFormatDate = (pDate) => {

  /* Converting the pDate parameter to a valid date format. */
  let vDate = moment(pDate, ["MM-DD-YYYY", "YYYY-MM-DD"]);
  
  return vDate.format("dddd, MMMM Do YYYY");
}




/* Return a Time Formated HH:MM AM/PM*/
const FGetTimeStr = (dt) => {
    
    let d = dt.toLocaleDateString();
    let t = dt.toLocaleTimeString();
    t = t.replace(/\u200E/g, '');
    
    t = t.replace(/^([^\d]*\d{1,2}:\d{1,2}):\d{1,2}([^\d]*)$/, '$1$2');        

    let result = (t.length === 7 ? '0': "") + t ;
    
    return result;  //(n < 10 ? '0' : '') + n;
}




const FconvertTime12to24 = (time12h) => {

  const [time, modifier] = time12h.split(' ');

  let [hours, minutes] = time.split(':');

  if (hours === '12') {
    hours = '00';
  }

  if (modifier === 'PM') {
    hours = parseInt(hours, 10) + 12;
  }

  return hours + ':' + minutes;
}



/* Returns Zero's in front of a Number. */
const FAddZeros = (n)  => {

  return ( parseInt(n) < 10)? '0' + n : (n < 100)? '' + n : '' + n;
}




/* Return Years to be Populate at a Combobox. */
const FReturnYears = (pElement) => {

  let currentYear = new Date().getFullYear();

  for (let i = 0; i < 10; i++ ) {

      $("#" + pElement).append(

        $('<option/>')
          .attr("value", currentYear + i)
          .text(currentYear + i)
      )
  }
}



/* Returns Today's Date in Epoch Format. */
const FTodaysDateEpoch = () => {

  return moment(new Date(), ["MM-DD-YYYY", "YYYY-MM-DD"]).unix();
}


/* Convert a Date format : MM/DD/YYYY to a Month, day, etc date. */
const FFormatDateUnix = (pDate) => {

  /* Converting the pDate parameter to a valid date format. */
  return moment(pDate, ["MM-DD-YYYY", "YYYY-MM-DD"]).unix();
}




/* Array GroupBy. */
Array.prototype.groupBy = function(prop) {

  return this.reduce(function(groups, item) {

    const val = item[prop]
    groups[val] = groups[val] || []
    groups[val].push(item)
    return groups
  }, {})
}


/* First Letter Upercase. */
const FCapitalize = (s) => {

  if (typeof s !== 'string') return ''

  return s.charAt(0).toUpperCase() + s.slice(1)
}





/* Populating the Form. */
const FPopulateForm = (pData, pFormName) => {

    pData.forEach(function (index) {

    /* Iterate all Form elements. */
    for (var i = 0; i < pFormName.elements.length; i++){

        switch (pFormName.elements[i].nodeName) {

            /* INPUT Type */
            case 'INPUT':
            
                /* Populating the Form. */
                pFormName.elements[i].value = index[pFormName.elements[i].getAttribute('id')];        
                break;
        
            /* SELECT Type */
            case 'SELECT':

                /* Populating the ComboBox. */
                pFormName.elements[i].options[pFormName.elements[i].selectedIndex].text = index[pFormName.elements[i].getAttribute('id')]; 
                break;


            }
        }    
    });
}


const FIsEmpty = pValue => {

  return pValue === undefined || pValue === null || ( typeof pValue === 'object' && Object.keys(pValue).length === 0 ) || ( typeof pValue === 'string' && pValue.trim().length === 0);
}



/* Validating the Form. */
const FValidateForm = (pFormName) => {

    let $toReturn = true;

    /* Iterate all Form elements. */
    for (var i = 0; i < pFormName.elements.length; i++){
      
        if(pFormName.elements[i].classList.contains('is_required') ){


            /* Change the Color of the Field. */
            ( ( FIsEmpty(pFormName.elements[i].value) ) ||  (pFormName.elements[i].value === "0") ) ? 

              /* Errors */
              FToggleColor(pFormName.elements[i].id, 'border-danger', 'border-success')
            :  
            
              /* Success*/
              FToggleColor(pFormName.elements[i].id, 'border-success', 'border-danger');

            /* Check if the Field has Been Filed. */
            $toReturn = ( ( pFormName.elements[i].value === "" ) || (pFormName.elements[i].value === "0") ) ? false: true;
        }
    }
  
    return $toReturn;
}



/* Return an Array with all Form Data. */
const FFormData = (pFormName) => {

    let pData = [];

    /* Iterate all Form Elements. */
    for (var i = 0; i < pFormName.elements.length; i++){

      switch (pFormName.elements[i].nodeName) {

        /* INPUT Type */
        case 'INPUT':      

          pData[pFormName.elements[i].getAttribute('data-id')] = pFormName.elements[i].value;
          break;

        /* SELECT Type */
        case 'SELECT':

          /* Getting the ComboBox Selected Text. */
          (pFormName.elements[i].value !== "0")?  
            
            pData[pFormName.elements[i].getAttribute('data-id')] = pFormName.elements[i].options[pFormName.elements[i].selectedIndex].text 
          :
            pData[pFormName.elements[i].getAttribute('data-id')] = "";
          break;          

      }
    }
    console.log(pData);
    return pData;
}




/* Togle the Element Color. */
const FToggleColor = (pElement, pClassAdd, pClassRemove) => {
    
    let vElement = document.getElementById(pElement);
    
    /* Adding Success Color */
    vElement.classList.add(pClassAdd); 

    /* Remove Danger Color */
    vElement.classList.remove(pClassRemove);
};


/* Remove all Specific Class from a Form */
const FRemoveClass = (pFormName, pClassRemove) => {

    /* Iterate all Form Elements. */
    for (var i = 0; i < pFormName.elements.length; i++){

        pClassRemove.forEach(function (index) {

            pFormName.elements[i].classList.remove(index)
        });        
    }
}