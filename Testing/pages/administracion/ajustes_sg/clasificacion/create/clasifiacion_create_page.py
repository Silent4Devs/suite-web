import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import password_c, username_c
from selenium.common.exceptions import TimeoutException

#Temporizadores
tiempo_modulos = 2

class Create_clasificacion:
    
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(self.driver, 10)

    def login(self):
        
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("Iniciando sesión en el sistema...")
        time.sleep(4)
        self._fill_input_field("input[name='email']", username_c)
        self._fill_input_field("input[name='password']", password_c)
        self._click_element("//button[@type='submit'][contains(text(),'Enviar')]")
        print("¡Sesión iniciada con éxito!")
        self.wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "img[alt='Logo Tabantaj']")))
        print("Login correcto.")
        
        print("URL actual:", self.driver.current_url)
        
        time.sleep(tiempo_modulos)
        
    def _fill_input_field(self, locator, value):
        input_field = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, locator)))
        input_field.clear()
        input_field.send_keys(value)

    def _click_element(self, xpath):
        element = self.wait.until(EC.element_to_be_clickable((By.XPATH, xpath)))
        element.click()

    def _wait_and_fill(self, xpath, value):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.clear()
            element.send_keys(value)
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")
        
    def _wait_and_select(self, selector, opcion):
        try:
            select_element = self.wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, selector)))
            select_element.click()
            option_xpath = f"//select[@name='sede']/option[text()='{opcion}']"
            option = self.wait.until(EC.visibility_of_element_located((By.XPATH, option_xpath)))
            option.click()
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {selector}")
 
    def _wait_and_click(self, xpath):
        try:
            element = self.wait.until(EC.visibility_of_element_located((By.XPATH, xpath)))
            element.click()
        except TimeoutException:
            raise TimeoutError(f"Elemento no encontrado en {xpath}")



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
        campo_id.send_keys("255199001")

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
        campo_descripcion.send_keys("Descripcion de Prueba Automatizada")
    
        time.sleep(tiempo_modulos)
        
        # Guardar
        guardar_xpath = "//button[@class='btn btn-primary' and normalize-space()='Guardar']"
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

