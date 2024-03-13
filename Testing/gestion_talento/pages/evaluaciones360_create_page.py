import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import pdb

#Temporizadores
tiempo_modulos = 5
tiempo_carga = 10
tiempo_espera = 3
tiempo_llenado = 2
tiempo_diez = 10

#----------------------------------------------------INICIO DE CLASE--------------------------------------------------------------------------

class Evaluaciones_360_create_page:
    
    def __init__(self, driver):
        self.driver = driver


    def login(self, username, password):
        
        #Entrando URL
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ LOGIN - TABANTAJ -----")
        time.sleep(5)
        
        #Ingresando Correo
        username_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='email']"))
        )
        username_input.clear()
        username_input.send_keys(username)
        print("Usario ingresado")

        #Ingresando Contraseña
        password_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='password']"))
        )
        password_input.clear()
        password_input.send_keys(password)
        print("Contraseña ingresada")

        #Dando clic botón Enviar
        submit_button = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(text(),'Enviar')]"))
        )
        submit_button.click()
        print("Enviando credenciales de acceso")
        
        #Encontrando imagen de Incio de Sesión
        WebDriverWait(self.driver, 2).until(
            EC.presence_of_element_located((By.XPATH, "//IMG[@src='https://192.168.9.78/img/logo-ltr.png']"))
        )
        print("Login correcto")
        
        print("URL actual:", self.driver.current_url)
        
        time.sleep(tiempo_modulos)
        
    def in_modulos(self):
        
        # Entrando a Menu Hamburguesa
        print("Entrando a Menu Hamburguesa...")
        btn_hmaburguesa = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//BUTTON[@class='btn-menu-header']"))
        )
        btn_hmaburguesa.click()
        
        time.sleep(tiempo_espera)
        
        # Entrando a Gestión Talento 
        print("Entrando a Gestión Talento...")
        btn_gt = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//A[@href='https://192.168.9.78/admin/capital-humano']"))
        )
        btn_gt.click()
        
        time.sleep(tiempo_espera)

        # Entrando a Sub Modulo Evalución 360
        print("Entrando a Sub Modulo Evalución 360...")
        btn_evaluaciones = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'Evaluación 360')]"))
        )
        btn_evaluaciones.click()
        
        time.sleep(tiempo_espera)
        
        # Entrando a Crear Evaluaciones
        print("Entrando a Crear Evaluaciones...")
        btn_crear_evaluaciones = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//A[@href='https://192.168.9.78/admin/recursos-humanos/evaluacion-360/evaluaciones/create']"))
        )
        btn_crear_evaluaciones.click()
        
        time.sleep(tiempo_espera)
        
        print("URL actual:", self.driver.current_url)
    
    def create_configuracion(self):
        
        # Llenando campo Nombre
        campo_nombre = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='nombre']"))
            )
        print("Dando click en campo nombre")
        campo_nombre.click()
        time.sleep(tiempo_llenado)
        print("Llenando campo nombre")
        campo_nombre.send_keys("Cesar Ernesto Escobar Hernandez")
        
        time.sleep(tiempo_espera)
        
        # Descripcion
        campo_descripcion = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//TEXTAREA[@class='form-control ']"))
            )
        print("Dando click en campo descripcion")
        campo_descripcion.click()
        time.sleep(tiempo_llenado)
        print("Llenando campo descripcion")
        campo_descripcion.clear()
        campo_descripcion.send_keys("Prueba de descripcion para pruebas modulos evaluaciones360")
        
        time.sleep(tiempo_espera)
        
        # Boton Competencias
        btn_competencias = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='checkmark'])[1]"))
            )
        print("Dando click en boton competencias")
        btn_competencias.click()
        
        time.sleep(tiempo_espera)
        
        # Boton Siguiente
        btn_siguiente = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//BUTTON[@type='button']"))
            )
        print("Dando click en siguiente")
        btn_siguiente.click()
        
        time.sleep(tiempo_espera)
        
        print("URL actual:", self.driver.current_url)
        
    def create_publico_objetivo(self):
        
        # Publico Objetivo
    
        campo_objetivo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='evaluados_objetivo']"))
            )
        print("Dando click en campo publico objetivo")
        campo_objetivo.click()
        time.sleep(tiempo_llenado)
        print("Llenando campo nombre")
        campo_objetivo.send_keys("Manualmente")
        print("Dando click en campo objetivo")
        time.sleep(tiempo_llenado)
        campo_objetivo.click()
        
        time.sleep(tiempo_espera)
        
        opciones_a_seleccionar = ["Cesar Ernesto Escobar Hernández","Zaid Arath García Hernández","Marti David Tendilla Gonzalez"]
        
        for opciones in opciones_a_seleccionar:
                input_chip = WebDriverWait(self.driver, 10).until(
                EC.presence_of_element_located((By.XPATH, "//li[contains(@class,'select2-search select2-search--inline')]"))
            )
                input_chip.click()
                xpath_opcion = f"//li[contains(text(), '{opciones}')]"
                opcion_elemento = WebDriverWait(self.driver, 10).until(
                EC.element_to_be_clickable((By.XPATH, xpath_opcion))
            )
                opcion_elemento.click()


            
        
        
        
        
        
        
    """ 
        # Seleccionar empleados a evaluar de publico objetivo
    def select_empleado (self):
       empleado_evaular_btn=WebDriverWait(self.driver,10).until(
           EC.visibility_of_all_elements_located((By.XPATH, "//li[contains(@class,'select2-search select2-search--inline')]"))
       )
       empleado_evaular_btn.click()
       select = Select(empleado_evaular_btn)
       select.select_by_index(2)
       time.sleep(tiempo_modulos)
       
        
        

        campo_empleados_2 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//LI[@class='select2-search select2-search--inline']"))
            )
        print("Dando click en campo selecciona empleados a evaluar")
        campo_empleados_2.click()
        time.sleep(tiempo_modulos)
        print("Llenando campo selecciona empleados a evaluar")
        campo_empleados_2.send_keys("Marti David Tendilla Gonzalez")
        print("Dando click en campo selecciona empleados a evaluar")
        time.sleep(tiempo_modulos)
        campo_empleados_2.click()
        
        time.sleep(tiempo_espera)
        
        campo_empleados_3 = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//LI[@class='select2-search select2-search--inline']"))
            )
        print("Dando click en campo selecciona empleados a evaluar")
        campo_empleados_3.click()
        time.sleep(tiempo_modulos)
        print("Llenando campo selecciona empleados a evaluar")
        campo_empleados_3.click("Zaid Arath García Hernández")
        print("Dando click en campo selecciona empleados a evaluar")
        time.sleep(tiempo_modulos)
        campo_empleados_3.click()
        
        time.sleep(tiempo_espera)
        
        # Boton Siguiente
        
        btn_siguiente = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//BUTTON[@type='button'])[5]"))
            )
        print("Dando click en siguiente")
        btn_siguiente.click()
        
        time.sleep(tiempo_espera)
        
        print("URL actual:", self.driver.current_url)
        """

