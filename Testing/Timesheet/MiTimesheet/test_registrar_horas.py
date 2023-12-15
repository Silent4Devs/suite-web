from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

# Configuración de tiempos
tiempo_modulos = 4
tiempo_carga = 10
tiempo_carga_timesheet = 35
tiempo_espera = 2.7

# Inicialización de identificadores
identificador = 1
identificador_proyecto = 1
identificador_tarea = 1

# Driver Firefox
driver = webdriver.Firefox()

# Abrir URL
driver.get('https://192.168.9.78/')

# Maximizar ventana
driver.maximize_window()
time.sleep(5)

# Login
usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo_modulos)
pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys("ranas289")
time.sleep(tiempo_modulos)
btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
btn.click()

# Registrar Horas
try:
    time.sleep(tiempo_carga)
    btn = driver.find_element(By.XPATH, "//font[@class='letra_blanca'][contains(.,'Timesheet')]")
    btn.click()
    time.sleep(tiempo_modulos)
    btn = driver.find_element(By.XPATH, "//a[contains(.,'Registrar Horas')]")
    time.sleep(tiempo_modulos)
    btn.click()
    time.sleep(tiempo_carga)
    date_input = driver.find_element(By.XPATH, "//input[@type='text'][contains(@id,'dia')]")
    date_input.click()
    day_element = driver.find_element(By.XPATH, "//span[@class='flatpickr-day'][contains(.,'8')]")
    day_element.click()
    time.sleep(tiempo_carga)

    def user_actions():
        select_container_xpath = f"//span[@class='select2-selection__rendered'][contains(@id,'proyectos{identificador_proyecto}-container')][contains(.,'Seleccione proyecto')]"
        select_container = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container_xpath)))
        select_container.click()

        search_proyecto = WebDriverWait(driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//input[contains(@class,'select2-search__field')]"))
        )
        search_proyecto.send_keys("TABANTAJ")

        WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, "//li[@class='select2-results__option']")))

        option_xpath = f"//li[contains(@id,'proyectos{identificador_proyecto}-result')][contains(.,'I 015 - PRO-INT-S4B Tabantaj')]"
        option_element = driver.find_element(By.XPATH, option_xpath)
        option_element.click()

        # TAREA
        search_tarea_container = WebDriverWait(driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, f"//span[@class='select2-selection__rendered'][contains(@id,'tareas{identificador_tarea}-container')][contains(.,'Seleccione tarea')]"))
        )
        search_tarea_container.click()

        search_tarea_input = WebDriverWait(driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//input[contains(@class,'select2-search__field')]"))
        )
        search_tarea_input.send_keys("Test")

        WebDriverWait(driver, 15).until(EC.presence_of_element_located((By.XPATH, "//li[@class='select2-results__option']")))

        option_tarea_xpath = f"//li[contains(.,'Testing UX')]"
        option_tarea_element = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, option_tarea_xpath)))
        option_tarea_element.click()

    for _ in range(4):  # Repetir 4 veces
        user_actions()

        monday = driver.find_element(By.XPATH, f"//input[contains(@name,'timesheet[{identificador}][lunes]')]").send_keys("24")
        time.sleep(tiempo_espera)
        tuesday = driver.find_element(By.XPATH, f"//input[contains(@name,'timesheet[{identificador}][martes]')]").send_keys("24")
        time.sleep(tiempo_espera)
        wednesday = driver.find_element(By.XPATH, f"//input[contains(@name,'timesheet[{identificador}][miercoles]')]").send_keys("24")
        time.sleep(tiempo_espera)
        thursday = driver.find_element(By.XPATH, f"//input[contains(@name,'timesheet[{identificador}][jueves]')]").send_keys("24")
        time.sleep(tiempo_espera)
        friday = driver.find_element(By.XPATH, f"//input[contains(@name,'timesheet[{identificador}][viernes]')]").send_keys("24")
        time.sleep(tiempo_espera)
        saturday = driver.find_element(By.XPATH, f"//input[contains(@name,'timesheet[{identificador}][sabado]')]").send_keys("24")
        time.sleep(tiempo_espera)
        sunday = driver.find_element(By.XPATH, f"//input[contains(@name,'timesheet[{identificador}][domingo]')]").send_keys("24")
        time.sleep(tiempo_espera)
        description = driver.find_element(By.XPATH, f"//textarea[contains(@name,'timesheet[{identificador}][descripcion]')]").send_keys(
            "北京位於華北平原的西北边缘，背靠燕山，有永定河流经老城西南，毗")
        # AGREGAR FILA
        addrow_btn = driver.find_element(By.XPATH, "//font[@class='d-mobile-none'][contains(.,'Agregar fila')]")
        addrow_btn.click()
        time.sleep(tiempo_espera)

        # Incrementar identificadores para la próxima iteración
        identificador += 1
        identificador_proyecto += 1
        identificador_tarea += 1



except TimeoutException as e:
    print(f"No se pudo seleccionar la tarea. Detalles: {e}")

except TimeoutException as e:
    print(f"No se pudo seleccionar el proyecto. Detalles: {e}")

#REGISTRAR
time.sleep(tiempo_espera)
registrar_btn = driver.find_element(By.XPATH, "//label[@for='estatus_pendiente'][contains(.,'Registrar')]")
time.sleep(tiempo_espera)
registrar_btn.click()
time.sleep(tiempo_espera)
aprobacion_btn = driver.find_element(By.XPATH, "//button[@data-dismiss='modal'][contains(@id,'time')][contains(.,'Enviar a Aprobación')]")
time.sleep(tiempo_espera)
aprobacion_btn.click()
time.sleep(tiempo_carga_timesheet)

ok_btn = driver.find_element(By.XPATH, "//button[@type='button'][contains(.,'OK')]")
time.sleep(tiempo_espera)
ok_btn.click()
time.sleep(tiempo_espera)

time.sleep(tiempo_espera)

# Cerrar el navegador al finalizar
driver.quit()
