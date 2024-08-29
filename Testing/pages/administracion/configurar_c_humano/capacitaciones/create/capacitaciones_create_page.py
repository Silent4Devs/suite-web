import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from config import password_c, username_c


#Temporizadores
tiempo_modulos = 2

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
        
        #Submodulo Glosario
        print("Ingresando a Submenu Capacitaciones ...")
        sub_modulo= WebDriverWait(self.driver, 10).until(
            EC.visibility_of_element_located((By.XPATH, element_entrar_submodulo))
        )
        sub_modulo.click()
        
        time.sleep(5)
        
        print("URL actual:", self.driver.current_url)



    ########################################## Agregar 

    def add_capacitaciones(self, agregar_btn_xpath, guardar_xpath):
        
        time.sleep(tiempo_modulos)
        
        # Dando clic en Boton Registrar Capacitaciones
        print("Dando clic al botón Registrar Capacitaciones...")
        wait = WebDriverWait(self.driver, 10)
        agregar_btn = wait.until(EC.presence_of_element_located((By.XPATH, agregar_btn_xpath)))
        agregar_btn.click()
        
        time.sleep(tiempo_modulos)

        # Nombre del Puesto
        campo_puestos = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='puesto']"))
            )
        campo_puestos.click()
        campo_puestos.send_keys("Nombre de Puesto de Prueba 00117")
        print("Llenando Campo Nombre del puestos ...")

        time.sleep(tiempo_modulos)

        # Area
        campo_area = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='id_area']"))
            )
        campo_area.click()
        time.sleep(tiempo_modulos)
        campo_area.send_keys("Arquitectura")
        time.sleep(tiempo_modulos)
        campo_area.click()
        print("Llenando Campo Area ...")

        time.sleep(tiempo_modulos)
        
        # Reportará a
        campo_reportara_a = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='reporta_puesto_id']"))
        )
        campo_reportara_a.click()
        time.sleep(tiempo_modulos)
        campo_reportara_a.send_keys("Consultor jr")
        time.sleep(tiempo_modulos)
        campo_reportara_a.click()
        print("Llenando Campo Reportará a ...")

        time.sleep(tiempo_modulos)

        # No. de personas a su cargo Internas
        campo_n_de_personas_internas = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control '])[2]"))
        )
        campo_n_de_personas_internas.click()
        campo_n_de_personas_internas.send_keys("5")
        print("Llenando Campo Numero de personas a su cargo internas...")

        time.sleep(tiempo_modulos)
        
        # No. de personas a su cargo Externas
        campo_n_de_personas_externas = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='form-control '])[3]"))
        )
        campo_n_de_personas_externas.click()
        campo_n_de_personas_externas.send_keys("5")
        print("Llenando Campo Numero de personas a su cargo externas ...")

        time.sleep(tiempo_modulos)

        # Actividad
        campo_actividad = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='actividad_responsabilidades']"))
        )
        campo_actividad.clear()
        campo_actividad.send_keys("Actividad de Prueba")
        print("Llenando Campo actividad ...")
    
        time.sleep(tiempo_modulos)

        # Resultado Esperado
        campo_esperado = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//TEXTAREA[@id='resultado_certificado_responsabilidades']"))
        )
        campo_esperado.clear()
        campo_esperado.send_keys("Resultado esperado de prueba")
        print("Llenando Campo Resultado esperado ...")
    
        time.sleep(tiempo_modulos)

        # Guardar
        guardar = WebDriverWait(self.driver, 20).until(
            EC.element_to_be_clickable((By.XPATH, guardar_xpath))
        )
        guardar.click()
        print("Dando click en boton guardar ...")

        time.sleep(tiempo_modulos)
        
        print("URL actual:", self.driver.current_url)
                    