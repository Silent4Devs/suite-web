import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

class Create_Glosario:
    
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

    def in_menu_h(self, menu_hamburguesa):
    
        time.sleep(tiempo_modulos)
        
        #Menu Hamburguesa
        print("Ingresando a Menu Hamburguesa")
        menu_hamb = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
        )
        menu_hamb.click()

        time.sleep(tiempo_modulos)
        
    def in_modulo(self, modulo, modulo_css):
        try:
            elemento = WebDriverWait(self.driver, 10).until(EC.element_to_be_clickable((By.XPATH, modulo)))
            elemento.click()
        except:
            elemento = WebDriverWait(self.driver, 10).until(EC.element_to_be_clickable((By.CSS_SELECTOR, modulo_css)))
            elemento.click()
        
        
    def in_submodulo(self,submodulo):
        
        #Submodulo Glosario
        
        print("Ingresando a Submenu Glosario ...")
        sub_modulo= WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, submodulo))
        )
        time.sleep(tiempo_modulos)
        sub_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)



    ########################################## Agregar 

    def add_glosario(self, agregar_btn_xpath, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Agregar Glosario
        print("Dando clic al botón Agregar Gloario...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Inciso
        campo_inciso = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='numero']"))
            )
        campo_inciso.click()
        campo_inciso.send_keys("01011712")
        print("Campo Inciso llenado")

        time.sleep(tiempo_modulos)
        
        # Norma
        campo_norma = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='norma']"))
            )
        campo_norma.click()
        campo_norma.send_keys("Norma de Prueba Carpetas")
        print("Campo Norma llenado")

        time.sleep(tiempo_modulos)
        
        # Concepto
        campo_concepto = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='concepto']"))
            )
        campo_concepto.click()  
        campo_concepto.send_keys("Concepto de Prueba Carpetas")
        print("Campo Concepto llenado")

        time.sleep(tiempo_modulos)
        
        # Definicion
        campo_definicion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='definicion']"))
            )
        campo_definicion.click()
        campo_definicion.send_keys("Definicion de prueba Carpetas")
        print("Campo Definicion llenado")
    
        time.sleep(tiempo_modulos)
        
        # Explicacion
        campo_explicacion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='explicacion']"))
            )
        campo_explicacion.click()
        campo_explicacion.send_keys("Explicacion de prueba carpetas")
        print("Campo Explicacion llenado")
        
        time.sleep(tiempo_modulos)
        
        # Guardar Repositorio
        print("Dando clic al botón Guardar...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        time.sleep(10)
        
        print("URL actual:", self.driver.current_url)
                    