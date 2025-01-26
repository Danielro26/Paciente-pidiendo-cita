const specialties = [
    { id: 1, name: 'Odontología' },
    { id: 2, name: 'Cancerología' },
    { id: 3, name: 'Salud General' },
  ];
  
  const doctors = [
    { id: 1, name: 'Dr. Juan Carlos Clavijo', specialty: 'Odontología', schedule: ['09:00', '10:00', '11:00'] },
    { id: 2, name: 'Dr. Richard Círculo', specialty: 'Cancerología', schedule: ['12:00', '13:00', '14:00'] },
    { id: 3, name: 'Dr. Walter Gómez', specialty: 'Salud General', schedule: ['15:00', '16:00', '17:00'] },
    { id: 4, name: 'Dra. Mellisa Velandia', specialty: 'Odontología', schedule: ['09:30', '10:30', '11:30'] },
    { id: 5, name: 'Dr. Jamez Lionel Silva', specialty: 'Cancerología', schedule: ['12:30', '13:30', '14:30'] },
  ];
  
  // Elementos del DOM
  const specialtySelect = document.getElementById('specialty');
  const doctorSelect = document.getElementById('doctor');
  const timeSelect = document.getElementById('time');
  const doctorSelection = document.getElementById('doctor-selection');
  const timeSelection = document.getElementById('time-selection');
  const confirmButton = document.getElementById('confirm-appointment');
  const appointmentsList = document.getElementById('appointments-list');
  const dateInput = document.getElementById('date');
  const homeScreen = document.getElementById('home-screen');
  const appointmentScreen = document.getElementById('appointment-screen');
  
  // Pantalla de inicio - mostrar la interfaz de gestión de citas
  document.getElementById('request-appointment-btn').addEventListener('click', () => {
    homeScreen.style.display = 'none';
    appointmentScreen.style.display = 'block';
  });
  
  // Cargar especialidades al inicio
  function loadSpecialties() {
    specialties.forEach((specialty) => {
      const option = document.createElement('option');
      option.value = specialty.name;
      option.textContent = specialty.name;
      specialtySelect.appendChild(option);
    });
  }
  
  // Limitar las fechas en el calendario
  function setDateRestrictions() {
    const currentDate = new Date();
    const minDate = new Date(currentDate.getFullYear(), 0, 28);
    const maxDate = new Date(currentDate.getFullYear() + 1, currentDate.getMonth(), currentDate.getDate());
  
    const minDateString = minDate.toISOString().split('T')[0];
    const maxDateString = maxDate.toISOString().split('T')[0];
  
    dateInput.setAttribute('min', minDateString);
    dateInput.setAttribute('max', maxDateString);
  }
  
  // Evento para manejar el cambio de especialidad
  specialtySelect.addEventListener('change', (e) => {
    const selectedSpecialty = e.target.value;
  
    doctorSelect.innerHTML = '<option value="">Seleccione un médico</option>';
    timeSelect.innerHTML = '<option value="">Seleccione un horario</option>';
    doctorSelection.classList.add('oculto');
    timeSelection.classList.add('oculto');
    confirmButton.disabled = true;
  
    if (selectedSpecialty) {
      const filteredDoctors = doctors.filter((doc) => doc.specialty === selectedSpecialty);
      filteredDoctors.forEach((doctor) => {
        const option = document.createElement('option');
        option.value = doctor.name;
        option.textContent = doctor.name;
        doctorSelect.appendChild(option);
      });
      doctorSelection.classList.remove('oculto');
    }
  });
  
  // Evento para manejar el cambio de médico
  doctorSelect.addEventListener('change', (e) => {
    const selectedDoctor = e.target.value;
  
    timeSelect.innerHTML = '<option value="">Seleccione un horario</option>';
    timeSelection.classList.add('oculto');
    confirmButton.disabled = true;
  
    if (selectedDoctor) {
      const doctor = doctors.find((doc) => doc.name === selectedDoctor);
      if (doctor) {
        doctor.schedule.forEach((time) => {
          const option = document.createElement('option');
          option.value = time;
          option.textContent = time;
          timeSelect.appendChild(option);
        });
        timeSelection.classList.remove('oculto');
      }
    }
  });
  
  // Evento para manejar el cambio de horario
  timeSelect.addEventListener('change', (e) => {
    confirmButton.disabled = !e.target.value;
  });
  
  // Evento para confirmar la cita
  confirmButton.addEventListener('click', (e) => {
    e.preventDefault();
  
    const selectedSpecialty = specialtySelect.value;
    const selectedDoctor = doctorSelect.value;
    const selectedTime = timeSelect.value;
    const selectedDate = dateInput.value;
  
    if (selectedSpecialty && selectedDoctor && selectedTime && selectedDate) {
      const appointmentItem = document.createElement('li');
      appointmentItem.textContent = `Especialidad: ${selectedSpecialty}, Médico: ${selectedDoctor}, Hora: ${selectedTime}, Fecha: ${selectedDate}`;
  
      const cancelButton = document.createElement('button');
      cancelButton.textContent = 'Cancelar';
      cancelButton.classList.add('cancel-button');
      cancelButton.addEventListener('click', () => cancelAppointment(appointmentItem));
  
      appointmentItem.appendChild(cancelButton);
      
      appointmentsList.appendChild(appointmentItem);
  
      specialtySelect.value = '';
      doctorSelect.innerHTML = '<option value="">Seleccione un médico</option>';
      timeSelect.innerHTML = '<option value="">Seleccione un horario</option>';
      dateInput.value = '';
      confirmButton.disabled = true;
      doctorSelection.classList.add('oculto');
      timeSelection.classList.add('oculto');
    }
  });
  
  // Función para cancelar la cita
  function cancelAppointment(appointmentItem) {
    appointmentsList.removeChild(appointmentItem);
  }
  
  // Función para modificar la cita
  function modifyAppointment(appointmentItem) {
    alert('Funcionalidad de modificar cita no implementada');
  }
  
  // Inicializar la carga de especialidades y restricciones de fecha
  loadSpecialties();
  setDateRestrictions();
  