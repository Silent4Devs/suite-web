import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c

#Temporizadores
tiempo_modulos = 2

class Edit_lista_de_distribucion:

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
        
        
        print("URL actual:", self.driver.current_url)


    ##########################################Entrar a Modulo y Submodulo

    def in_submodulo(self, menu_hamburguesa, element_confirgurar_organizacion, element_entrar_submodulo):
        
        #Menu Hamburguesa
        print("Ingresando a Menu Hamburguesa")
        menu_hamb = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
        )
        menu_hamb.click()

        time.sleep(tiempo_modulos)
        
        #Modulo Ajustes SG
        print("Ingresando a Moldulo Ajustes SG")
        modulo = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_confirgurar_organizacion))
        )
        modulo.click()
        
        time.sleep(tiempo_modulos)
        
        #Submodulo Lista de Distribucion 
        print("Ingresando a Submenu Clausula")
        sub_modulo= WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, element_entrar_submodulo))
        )
        sub_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

    ########################################## Agregar Clasificacion y llenar repositorio
    
    def update_lista_de_distribucion(self, trespuntos_btn_xpath, boton_editar):
        
        # Boton 3 puntos
        print("Dando clic al botón 3 puntos...")
        wait = WebDriverWait(self.driver, 10)
        # Esperar a que el elemento esté presente en el DOM
        puntos_btn = wait.until(EC.presence_of_element_located((By.XPATH, trespuntos_btn_xpath)))
        # Ahora intenta hacer clic en el elemento
        puntos_btn.click()

        time.sleep(tiempo_modulos)

        # Boton editar
        print("Dando clic al botón editar...")
        wait = WebDriverWait(self.driver, 10)
        # Esperar a que el elemento esté presente en el DOM
        btn_editar = wait.until(EC.presence_of_element_located((By.XPATH, boton_editar)))
        # Ahora intenta hacer clic en el elemento
        btn_editar.click()

        time.sleep(tiempo_modulos)  
        
        # Super Aprobadores
        campo_aprobadores = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='select2-selection select2-selection--multiple'])[1]"))
            )
        campo_aprobadores.click()
        time.sleep(5)
        campo_aprobadores.send_keys("Cesar Ernesto Escobar hernandez")
        time.sleep(5)
        campo_aprobadores.click()

        time.sleep(tiempo_modulos)

        # Guardar actualización
        print("Dando clic al botón Guardar para guardar actualización...")
        guardar_xpath = "//BUTTON[@type='submit'][text()='Editar']"
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)