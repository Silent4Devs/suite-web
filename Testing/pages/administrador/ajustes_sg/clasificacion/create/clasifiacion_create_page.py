import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

#Temporizadores
tiempo_modulos = 2

class Create_clasificacion:

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



    ##########################################Entrar a Modulo y Submodulo

    def in_submodulo(self, menu_hamburguesa,element_confirgurar_organizacion,element_entrar_submodulo):
        
        #Menu Hamburguesa
        print("Ingresando a Menu Hamburguesa")
        menu_hamb = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
        )
        menu_hamb.click()

        time.sleep(tiempo_modulos)
        
        #Modulo Ajustes SG
        print("Ingresando a Moldulo Ajustes SG")
        menu_sg = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_confirgurar_organizacion))
        )
        menu_sg.click()
        
        time.sleep(tiempo_modulos)
        
        #Submodulo Clasificacion
        print("Ingresando a Submenu Clasificacion")
        sub_clasif= WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo))
        )
        sub_clasif.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

    ########################################## Agregar Clasificacion y llenar repositorio

    def add_clasificacion(self,agregar_btn_xpath):
        
        # Dando clic en Boton Nueva Clasificacion
        print("Dando clic al botón nueva clasificacion..")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # ID
        campo_id = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='identificador']"))
            )
        campo_id.click()
        campo_id.send_keys("255199")

        time.sleep(tiempo_modulos)
        
        # Clasificacion
        campo_clasificacion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='nombre']"))
            )
        campo_clasificacion.click()
        campo_clasificacion.send_keys("Clasificacion de Prueba")

        time.sleep(tiempo_modulos)
        
        # Descripcion
        campo_descripcion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='descripcion']"))
            )
        campo_descripcion.click()
        campo_descripcion.send_keys("Descripcion de Prueba")
    
        time.sleep(tiempo_modulos)
        
        # Guardar
        guardar_xpath = "//button[@class='btn btn-danger' and normalize-space()='Guardar']"
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

