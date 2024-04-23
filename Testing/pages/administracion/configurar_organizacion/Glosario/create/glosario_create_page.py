import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c
import pdb


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

    def ruta_glosario_index(self, url_glosario):
        try:
            self.driver.get(url_glosario)
            print("Index de Configurar Organizacio / Glosario cargado.")
        except Exception as e:
            print("Error al cargar el index de Configurar Organizacio / Glosario", e)
            pdb.set_trace()

    ########################################## Agregar 

    def add_glosario(self, agregar_btn_xpath, inciso, norma, concepto, definicion, explicacion, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Agregar Glosario
        print("Dando clic al botón Agregar Gloario...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Inciso
        print("Campo Inciso llenado")
        campo_inciso = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, inciso))
            )
        campo_inciso.click()
        campo_inciso.send_keys("01011712")

        time.sleep(tiempo_modulos)
        
        # Norma
        print("Campo Norma llenado")
        campo_norma = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, norma))
            )
        campo_norma.click()
        campo_norma.send_keys("Norma de Prueba Carpetas")

        time.sleep(tiempo_modulos)
        
        # Concepto
        print("Campo Concepto llenado")
        campo_concepto = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, concepto))
            )
        campo_concepto.click()  
        campo_concepto.send_keys("Concepto de Prueba Carpetas")
        
        time.sleep(tiempo_modulos)
        
        # Definicion
        print("Campo Definicion llenado")
        campo_definicion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, definicion))
            )
        campo_definicion.click()
        campo_definicion.send_keys("Definicion de prueba Carpetas")
    
        time.sleep(tiempo_modulos)
        
        # Explicacion
        print("Campo Explicacion llenado")
        campo_explicacion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, explicacion))
            )
        campo_explicacion.click()
        campo_explicacion.send_keys("Explicacion de prueba carpetas")
        
        time.sleep(tiempo_modulos)
        
        # Guardar Repositorio
        print("Dando clic al botón Guardar...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        time.sleep(10)
        
        print("URL actual:", self.driver.current_url)
                    