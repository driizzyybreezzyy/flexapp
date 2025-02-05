import React, { useState } from 'react';

const AdmissionForm = () => {
  const [age, setAge] = useState('');
  const [batch, setBatch] = useState('');
  const [isEligible, setIsEligible] = useState(true);

  const handleAgeChange = (event) => {
    const age = parseInt(event.target.value, 10);
    if (age >= 18 && age <= 65) {
      setIsEligible(true);
    } else {
      setIsEligible(false);
    }
    setAge(event.target.value);
  };

  const handleBatchChange = (event) => {
    setBatch(event.target.value);
  };

  const handleSubmit = async () => {
    if (age && batch && isEligible) {
      try {
        const response = await fetch('http://localhost/flexapp/userInsertValue.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ age: age, batch: batch }),
        });
  
        if (!response.ok) {
          throw new Error('Failed to submit');
        }
  
        const data = await response.json();
        console.log(data);
  
        if (data.status === 'success') {
          alert(`You have been enrolled in the ${batch} batch. Please pay Rs. 500 for this month.`);
        } else {
          alert("Failed to submit data. Error: " + data.message);
        }
      } catch (error) {
        console.error('Error:', error);
        alert("There was an error with the submission. Please try again.");
      }
    } else {
      alert("Please ensure all fields are filled correctly and you are eligible to enroll.");
    }
  };
  

  return (
    <div className="container mt-5">
      <div className="row justify-content-center">
        <div className="col-md-6">
          <form className="card p-4">
            <h1 className="text-center">Admission Form</h1>
            <div className="mb-3">
              <label htmlFor="ageInput" className="form-label" style={{ fontWeight: 'bold' }}>
                Age
              </label>
              <input
                type="number"
                className={`form-control ${!isEligible && age ? 'is-invalid' : ''}`}
                id="ageInput"
                value={age}
                onChange={handleAgeChange}
                placeholder="Enter your age"
              />
              {!isEligible && age && <div className="invalid-feedback">Age must be between 18 and 65.</div>}
            </div>
            <div className="mb-3">
              <label htmlFor="batchSelect" className="form-label" style={{ fontWeight: 'bold' }}>
                Select Batch
              </label>
              <select
                className="form-select"
                id="batchSelect"
                value={batch}
                onChange={handleBatchChange}
              >
                <option value="">Select a batch</option>
                <option value="6-7AM">6-7AM</option>
                <option value="7-8AM">7-8AM</option>
                <option value="8-9AM">8-9AM</option>
                <option value="5-6PM">5-6PM</option>
              </select>
            </div>
            <button
              type="button"
              className="btn btn-primary w-100"
              onClick={handleSubmit}
            >
              Enroll
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default AdmissionForm;
