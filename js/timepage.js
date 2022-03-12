const time = document.getElementById("time");


let date =new Date();
const arrMonth = ['January','February','March','April','May','June','July','August',
                    'September', 'October','November','December'
];
 let month = date.getMonth();
 let year = (date.getFullYear()<1900)?date.getFullYear()+1000:date.getFullYear();
 let day = (date.getDate()<10)? "0" + date.getDate(): date.getDate();
 let minutes = (date.getMinutes()<10)?"0"+ date.getMinutes(): date.getMinutes();
 let hour = (date.getHours()<10)?"0"+ date.getHours(): date.getHours();
 let seconds = (date.getSeconds()<10)?"0"+ date.getSeconds(): date.getSeconds();

 let lastHour = (hour>12)?hour+12:hour;
 let fullDate = day +" "+ arrMonth[month]+ ", " + year +"  " + lastHour+":"+minutes+":"+seconds ;

setInterval(()=>{
    time.innerHTML = fullDate;
},1000)
