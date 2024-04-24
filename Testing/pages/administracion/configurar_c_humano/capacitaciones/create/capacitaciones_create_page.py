import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 1

class Create_Capacitaciones:
    
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


    ########################################## Entrar a Modulo y Submodulo

    print("Entrando a módulo correspondiente")
    def ruta_clausula_index(self, url_apartado_index):
        try:
            self.driver.get(url_apartado_index)
            print("Index de Configurar C. Humano / Capacitaciones")
        except Exception as e:
            print("Error al cargar el index de Configurar C. Humano / Capacitaciones", e)
        
        print("URL actual:", self.driver.current_url)

    ########################################## Agregar 

    def add_capacitaciones(self, agregar_btn_xpath, titulo, categoria, tipo, modalidad, ubicacion, instructor, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Registrar Capacitaciones
        print("Dando clic al botón Registrar Capacitaciones...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)

        # Titulo
        print("Llenando campo Titulo ...")
        campo_titulo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, titulo))
            )
        campo_titulo.click()
        campo_titulo.send_keys("Nombre de Puesto de Prueba 00117")
        print("Llenando Campo Nombre del puestos ...")

        time.sleep(tiempo_modulos)

        # Categoria
        print("Llenando campo Categoria")
        campo_categoria = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, categoria))
            )
        campo_categoria.click()
        time.sleep(5)
        campo_categoria.send_keys("Desarrollo")
        time.sleep(5)
        campo_categoria.click()
        
        time.sleep(tiempo_modulos)
        
        # Tipo
        print("Llenando Campo Tipo...")
        campo_tipo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, tipo))
        )
        campo_tipo.click()
        time.sleep(5)
        campo_tipo.send_keys("Diplomado")
        time.sleep(5)
        campo_tipo.click()
        
        time.sleep(tiempo_modulos)
        
        # Modalidad
        print("Llenando Campo Modalidad...")
        campo_modalidad = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, modalidad))
        )
        campo_modalidad.click()
        time.sleep(5)
        campo_modalidad.send_keys("Presencial")
        time.sleep(5)
        campo_modalidad.click()
        
        time.sleep(tiempo_modulos)
        
        # Ubicacion
        print("Llenando Campo Ubicacion...")
        campo_ubicacion = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, ubicacion))
        )
        campo_ubicacion.send_keys("Torre Murano")
        
        time.sleep(tiempo_modulos)
        
        # Instructor
        print("Llenando Campo Instructor...")
        campo_instructor = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, instructor))
        )
        campo_instructor.send_keys("César Ernesto Escobar Hernandez")
        
        time.sleep(tiempo_modulos)

        # Guardar
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        print("Dando click en boton guardar ...")

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)
                    