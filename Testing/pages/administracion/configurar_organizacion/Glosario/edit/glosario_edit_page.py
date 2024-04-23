import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import pdb
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

class Edit_Gloario:
    
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
    
    
        
    ########################################## Editar

    def edit_glosario(self, campo_buscar_xpath, boton_editar, definicion, guardar_xpath):
        
        # Campo Buscar
        campo_entrada = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, campo_buscar_xpath))
        )
        campo_entrada.clear()
        campo_entrada.send_keys("3.5")
        print("Campo Buscar llenado")

        time.sleep(tiempo_modulos)
        
        # Boton editar
        print("Dando clic al botón editar...")
        wait = WebDriverWait(self.driver, 10)
        # Esperar a que el elemento esté presente en el DOM
        btn_editar = wait.until(EC.presence_of_element_located((By.XPATH,boton_editar)))
        # Ahora intenta hacer clic en el elemento
        btn_editar.click()

        time.sleep(tiempo_modulos)  
        
        # Definicion
        print("Llenando Campo Definicion Actualizado")
        campo_definicion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, definicion))
            )
        campo_definicion.click()
        campo_definicion.send_keys("Definicion de prueba Actualizado 222")
    
        time.sleep(tiempo_modulos)

        # Guardar actualización
        print("Dando clic al botón Guardar para guardar actualización...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)
                        