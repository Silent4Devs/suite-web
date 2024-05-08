import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import Select

from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

class Create_Empleados:
    
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
    
    print("Entrando a módulo correspondiente")
    def ruta_empleados_index(self, url_apartado_index):
        try:
            self.driver.get(url_apartado_index)
            print("Index de Configurar C. Humano / Empleados")
        except Exception as e:
            print("Error al cargar el index de Configurar C. Humano / Empleados", e)
        
        print("URL actual:", self.driver.current_url)

    ########################################## Agregar 

    def add_empleados(self, agregar_btn):
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Registrar Empleados
        print("Dando clic al botón Registrar Empleados..")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)
        
    def select_nombre(self, nombre):
        # Nombre
        print("Llenando Campo Nombre ...")
        campo_nombre = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, nombre))
            )
        campo_nombre.click()
        campo_nombre.send_keys("Nombre de Prueba 00117")

        time.sleep(tiempo_modulos)
    """
    def select_area(self,area):
        try:
            input_area = self.driver.find_element(By.XPATH, area)
            input_area.click()
            print("Área seleccionada correctamente")
            
        except Exception as e:
            print("Error al seleccionar el área")
      
    def _select_option_by_text(self, area):
        select = Select(self.driver.find_element(By.XPATH, area))
        select.select_by_visible_text("Desarrollo")
    """
    def select_area(self, area):
        # Area
        print("Llenando Campo Area ...")
        campo_area = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, area))
        )
        campo_area.click()
        time.sleep(3)
        campo_area.send_keys("Desarrollo")
        time.sleep(3)
        campo_area.click
        
        
        time.sleep(tiempo_modulos)
    def select_puesto(self, puesto):
        # Puesto
        print("Llenando Campo Puesto ...")
        campo_puesto = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, puesto))
        )
        campo_puesto.click()
        time.sleep(5)
        campo_puesto.send_keys("Operativo")
        time.sleep(5)
        campo_puesto.click()
        
        time.sleep(tiempo_modulos)
        
    def select_jefe(self,jefe):
        # Jefe Inmediato
        print("Llenando Campo Jefe Inmediato ...")
        campo_jefe_in = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, jefe))
            )
        campo_jefe_in.click()
        time.sleep(5)
        campo_jefe_in.send_keys("Jorge Luis Chávez Sánches")
        time.sleep(5)
        campo_jefe_in.click()

        time.sleep(tiempo_modulos)
    
    def select_nivel_jerarquico(self, nivel_jerarquico):
        
        # Nivel Jerarquico
        print("Llenando Campo Nivel Jerarquico ...")
        campo_nivel_jer = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, nivel_jerarquico))
            )
        campo_nivel_jer.click()
        time.sleep(5)
        campo_nivel_jer.send_keys("Director")
        time.sleep(5)
        campo_nivel_jer.click()

        time.sleep(tiempo_modulos)

    def select_sexo(self,sexo):    
        # Sexo
        print("Llenando Campo Sexo ...")
        campo_sexo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, sexo))
        )
        campo_sexo.click()
        time.sleep(5)
        campo_sexo.send_keys("Hombre")
        time.sleep(5)
        campo_sexo.click()

        time.sleep(tiempo_modulos)
        
    def select_correo(self,correo):    
        # Correo electronico
        print("Llenando Campo Correo Electronico ...")
        campo_correoelectronico = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, correo))
            )
        campo_correoelectronico.click()
        campo_correoelectronico.send_keys("correo@prueba.com")

        time.sleep(tiempo_modulos)
    
    def select_sede(self,sede):    
        # Sede
        print("Llenando Campo Sede ...")
        campo_sede = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, sede))
        )
        campo_sede.click()
        campo_sede.send_keys("Torre Murano")
        campo_sede.click()

        time.sleep(tiempo_modulos)
    
    def select_fecha(self, fecha_ingreso):
        
        # Fecha de Ingreso
        print("Llenando Campo Fecha de Ingreso ...")
        campo_fecha_ingreso = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, fecha_ingreso))
        )
        campo_fecha_ingreso.click()
        time.sleep(5)
        campo_fecha_ingreso.send_keys("02/02/2024")
        time.sleep(5)
        campo_fecha_ingreso.click()

        time.sleep(tiempo_modulos)
        
    def select_guardar(self,guardar_xpath):
        # Guardar
        print("Dando clic al botón guardar ...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)
                        