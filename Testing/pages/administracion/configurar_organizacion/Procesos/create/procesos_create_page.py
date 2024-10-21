import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c
import pdb


#Temporizadores
tiempo_modulos = 2

class Create_Procesos:
    
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

    def ruta_procesos_index(self, url_procesos_index):
        try:
            self.driver.get(url_procesos_index)
            print("Index de Configurar Organizacion / Procesos cargado.")
        except Exception as e:
            print("Error al cargar el index de Configurar Organizacion / Procesos", e)
            pdb.set_trace()

    ########################################## Agregar Crear Areas

    def add_procesos(self, agregar_btn_xpath, codigo, nombre, macroprocesos, descripcion, guardar_xpath):
        
        # Dando clic en Boton Resgistrar Procesos
        print("Dando clic al botón registrar procesos...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Codigo
        campo_codigo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, codigo))
            )
        campo_codigo.click()
        campo_codigo.send_keys("000117")
        print("Escribiendo Campo Codigo")

        time.sleep(tiempo_modulos)
        
        # Nombre
        campo_nombre = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, nombre))
            )
        campo_nombre.click()
        campo_nombre.send_keys("Nombre de Prueba")
        print("Escribiendo Campo Nombre")

        time.sleep(tiempo_modulos)
        
        # Macroproceso
        campo_macroproceso = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, macroprocesos))
            )
        campo_macroproceso.click()
        time.sleep(tiempo_modulos)
        campo_macroproceso.send_keys("AFI")
        time.sleep(tiempo_modulos)
        campo_macroproceso.click()
        print("Escribiendo Campo Macroproceso")
    
        time.sleep(tiempo_modulos)
        
        # Descripcion
        campo_descripcion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, descripcion))
            )
        campo_descripcion.click()
        campo_descripcion.send_keys("Descripcion de prueba")
        print("Escribiendo Campo Descripcion")
    
        time.sleep(tiempo_modulos)
        
        # Guardar Repositorio
        print("Dando clic al botón Guardar...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        print("URL actual:", self.driver.current_url)

            