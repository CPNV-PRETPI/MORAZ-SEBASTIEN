import { render, screen } from '@testing-library/react';
import App from './App';

test('renders learn react link', () => {
  render(<App />);
  const linkElement = screen.getByText(/Element de test pour les tests unitaires/i);
  expect(linkElement).toBeInTheDocument();
});
