# Health-Kit
💊  A 24 hr Hackathon project to monitor user's health on daily basis through a kit. The project contains a hardware kit and its android app and website.
    <p>
    <img src="https://cloud.githubusercontent.com/assets/19619541/22738013/a29692fa-ee2b-11e6-960e-5200112522b5.jpg" width="300" hieght="400"/>
   </p>
Hardware
----------
  A circuit to check the heartbeat and temperature of user is made. The modules are:
      
  
 Pulse rate sensor:<br />
      It is made using IR emitter-sensor pair which is stick together using black tape. While the heart is beating, it is actually pumping blood throughout the body, and that makes the blood volume inside the finger artery to change too. This fluctuation of blood can be detected through IR emitter-sensor pair  sensing mechanism placed around the fingertip. The signal at the sensor is then passed through a high pass and a low pass filters which cancels signal of frequency more 4Hz and less than 1Hz.
    <p>
    <img src="https://cloud.githubusercontent.com/assets/19619541/22738024/acf057fe-ee2b-11e6-971d-5b05b229ac2b.jpg" width="200" hieght="200"/>
    <img src="http://robotshop.com/letsmakerobots/files/field_primary_image/Pulse_sensor_circuit.jpg?" width="400" hieght="600"/>
    </p>
    
      
 Temperature sensor:<br />
        A body temperature sensor using lm35 the circuit is given in image.
        ating, it is actually pumping blood throughout the body, and that makes the blood volume inside the finger artery to change too. This fluctuation of blood can be detected through IR emitter-sensor pair  sensing mechanism placed around the fingertip. The signal at the sensor is then passed through a high pass and a low pass filters which cancels signal of frequency more 4Hz and less than 1Hz.
    <p>
    <img src="https://cloud.githubusercontent.com/assets/19619541/22738025/ad58cd34-ee2b-11e6-8a62-0ae21fa95d94.png" width="400" hieght="500"/>
    </p>
        
          
          
Software
-------------
The software part includes getting uploading the data through arduino. The data is uploaded to thingsspeak which is fetched using JSON. The software part includes:
Health-kit Companion
    An android app to fetch uploaded data in JSON data using Thingspeak API. The app helps the user to keep track of daily health parameters and book an appointment if the user wants or if the parameters are below a certain threshold.  
     <p>
    <img src="https://cloud.githubusercontent.com/assets/19619541/22738943/9d58dd8a-ee2f-11e6-8430-216082c28d30.png" width="300" hieght="400"/>
    <img src="https://cloud.githubusercontent.com/assets/19619541/22738941/9bb1a3cc-ee2f-11e6-9c12-b06388641f3f.png" width="300" hieght="400"/>
   </p>
    An online portal to register new patients and doctors and to provide the summary of the appointment for the user.
      <p>
    <img src="https://cloud.githubusercontent.com/assets/19619541/22740843/33dd9d84-ee37-11e6-9615-9cc6d1c6e5bc.png" width="500" hieght="600"/>
    <img src="https://cloud.githubusercontent.com/assets/19619541/22740844/33de4158-ee37-11e6-92b3-6117b4f6c5bd.png" width="300" hieght="400"/>
   </p>
   
   TEAM MEMBERS
   --------------
   The contributors of this project are Ajay Chowdhary, Akshay k Sood, Gaurav Rana and Siddharth Kella.    
   
   
   
   
   
    