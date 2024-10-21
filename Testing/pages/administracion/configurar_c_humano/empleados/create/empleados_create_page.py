import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
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

    def in_submodulo(self, menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo):
    
        time.sleep(tiempo_modulos)
        
        #Menu Hamburguesa
        print("Ingresando a Menu Hamburguesa")
        menu_hamb = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, menu_hamburguesa))
        )
        menu_hamb.click()

        time.sleep(5)
        
        #Modulo Configurar C.Humano
        print("Ingresando a Modulo Configurar C.Humano ...")
        in_modulo = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, element_entrar_modulo))
        )
        in_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        #Submodulo Empleados
        print("Ingresando a Submenu Empleados ...")
        sub_modulo= WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, element_entrar_submodulo))
        )
        sub_modulo.click()
        
        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)

    ########################################## Agregar 

    def add_empleados(self, agregar_btn_xpath, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Registrar Empleados
        print("Dando clic al botón Registrar Empleados..")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)

        # Nombre
        print("Llenando Campo Nombre ...")
        campo_nombre = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='name']"))
            )
        campo_nombre.click()
        campo_nombre.send_keys("Nombre de Prueba 00117")

        time.sleep(tiempo_modulos)

        # Area
        print("Llenando Campo Area ...")
        campo_area = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SPAN[@id='select2-inputGroupSelect01-container']"))
        )
        campo_area.click()
        time.sleep(tiempo_modulos)
        campo_area.send_keys("Arquitectura")
        time.sleep(tiempo_modulos)
        campo_area.click()
        
        time.sleep(tiempo_modulos)
        
        # Puesto
        print("Llenando Campo Puesto ...")
        campo_puesto = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SPAN[@id='select2-puesto_id-container']"))
        )
        campo_puesto.click()
        time.sleep(tiempo_modulos)
        campo_puesto.send_keys("Operativo")
        time.sleep(tiempo_modulos)
        campo_puesto.click()
        
        time.sleep(tiempo_modulos)
        
        # Jefe Inmediato
        print("Llenando Campo Jefe Inmediato ...")
        campo_jefe_in = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SPAN[@id='select2-inputGroupSelect01-container']"))
            )
        campo_jefe_in.click()
        time.sleep(tiempo_modulos)
        campo_jefe_in.send_keys("Jorge Luis Chávez Sánches")
        time.sleep(tiempo_modulos)
        campo_jefe_in.click()

        time.sleep(tiempo_modulos)
        
        # Nivel Jerarquico
        print("Llenando Campo Nivel Jerarquico ...")
        campo_nivel_jer = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SPAN[@id='select2-perfil_empleado_id-container']"))
            )
        campo_nivel_jer.click()
        time.sleep(tiempo_modulos)
        campo_nivel_jer.send_keys("Director")
        time.sleep(tiempo_modulos)
        campo_nivel_jer.click()

        time.sleep(tiempo_modulos)
        
        # Sexo
        print("Llenando Campo Sexo ...")
        campo_sexo = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SPAN[@id='select2-genero-container']"))
        )
        campo_sexo.click()
        time.sleep(tiempo_modulos)
        campo_sexo.send_keys("Hombre")
        time.sleep(tiempo_modulos)
        campo_sexo.click()

        time.sleep(tiempo_modulos)
        
        # Correo electronico
        print("Llenando Campo Correo Electronico ...")
        campo_correoelectronico = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='email']"))
            )
        campo_correoelectronico.click()
        campo_correoelectronico.send_keys("correo@prueba.com")

        time.sleep(tiempo_modulos)
        
        # Sede
        print("Llenando Campo Sede ...")
        campo_sede = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SPAN[@id='select2-sede_id-container']"))
        )
        campo_sede.click()
        campo_sede.send_keys("Torre Murano")
        campo_sede.click()

        time.sleep(tiempo_modulos)
        
        # Fecha de Ingreso
        print("Llenando Campo Fecha de Ingreso ...")
        campo_fecha_ingreso = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='antiguedad']"))
        )
        campo_fecha_ingreso.click()
        time.sleep(tiempo_modulos)
        campo_fecha_ingreso.send_keys("02/02/2024")
        time.sleep(tiempo_modulos)
        campo_fecha_ingreso.click()

        time.sleep(tiempo_modulos)

        # Guardar
        print("Dando clic al botón guardar ...")
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)
                        