import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import AdmissionForm from './AdmissionForm'
import 'bootstrap/dist/css/bootstrap.min.css';
import './Basic.css'

function App() {
  const [count, setCount] = useState(0)

  return (
    <div className="App">
      <header className="App-header">
        <h1 className='Header'>Yoga Class Admission Form</h1>
      </header>
      <AdmissionForm />
    </div>
  );
}

export default App
