import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c
import pdb


#Temporizadores
tiempo_modulos = 2

class Macroprocesos_Create:
    
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

    def ruta_macroprocesos_index(self, url_macroprocesos_index):
        try:
            self.driver.get(url_macroprocesos_index)
            print("Index de Configurar Organizacion / Macroprocesos cargado.")
        except Exception as e:
            print("Error al cargar el index de Configurar Organizacion / Macroprocesos", e)
            pdb.set_trace()
    

    ########################################## Agregar Crear Areas

    def add_crear_macroprocesos(self, agregar_btn_xpath, codigo, nombre, grupo, descripcion, guardar_xpath):
        
        # Dando clic en Boton Agregar Macroprocesos
        print("Dando clic al botón Agregar Crear Macroproceso...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
        # Codigo
        print("Escribiendo Campo Codigo ...")
        campo_codigo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, codigo))
            )
        campo_codigo.click()
        campo_codigo.send_keys("00117")

        time.sleep(tiempo_modulos)
        
        # Nombre 
        print("Escribiendo Campo Nombre del activo ...")
        campo_nombre = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, nombre))
            )
        campo_nombre.click()
        campo_nombre.send_keys("Nombre del activo de prueba")

        time.sleep(tiempo_modulos)
        
        # Grupo
        print("Escribiendo Campo Grupo ...")
        campo_grupo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, grupo))
            )
        campo_grupo.click()
        time.sleep(tiempo_modulos)
        campo_grupo.send_keys("Grupo Soporte")
        time.sleep(tiempo_modulos)
        campo_grupo.click()
        
        time.sleep(tiempo_modulos)
        
        # Descripcion
        print("Escribiendo Campo Descripcion ...")
        campo_nombre = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, descripcion))
            )
        campo_nombre.click()
        campo_nombre.send_keys("Descripcion del macroproceso de prueba")

        time.sleep(tiempo_modulos)
        
        # Guardar Repositorio
        print("Dando clic al botón Guardar ...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

        